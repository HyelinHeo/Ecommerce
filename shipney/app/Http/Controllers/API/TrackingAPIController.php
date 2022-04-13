<?php
/**
 * File name: TrackingAPIController.php
 * Last modified: 2020.05.31 at 19:34:40
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\Http\Controllers\API;

use GuzzleHttp\Client as HttpClient;
use Dompdf\Helpers;

use App\Repositories\TrackingRepository;
use App\Repositories\OrderPickupRepository;
use App\Repositories\OrderRepository;

use App\Http\Controllers\Controller;
use Braintree\Gateway;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class TrackingAPIController
 * @package App\Http\Controllers\API
 */
class TrackingAPIController extends Controller
{
    private $etomars_key = "37fa5f9c16894b8184cdc1f04";
    private $request_tracking_etomars = "https://cbt.shipnergy.com/apiv2/GetTracking";

    /** @var  OrderPickupRepository */
    private $orderPickupRepository;
    private $trackingRepository;    

    /**
     * TrackingAPIController constructor.
     */
    public function __construct(OrderPickupRepository $orderPickupRepo, TrackingRepository $trackingRepo)
    {
        $this->orderPickupRepository = $orderPickupRepo;
        $this->trackingRepository = $trackingRepo;
    }

    public function trackingCreate($input_tracking)
    {
        $orderno = $input_tracking['orderno'] ?? '';

        if(strlen($orderno) > 0 && strlen($orderno) > 0) {
            try {
                $tracking['orderno'] = $orderno;
                $updated_at = $input_tracking['updated_at'] ?? '';

                $tracking['REG'] = "register done [".$updated_at."]";

                $this->trackingRepository->create($tracking);

                return 1;
            } catch (ValidatorException $e) {
                echo $e;
                return -1;
            }
        } else {
            return -2;
        }
    }

    public function trackingUpdate($orderno, $orderstate, $comment)
    {
        if(strlen($orderno) > 0 && strlen($orderno) > 0) {
            $updatefield = "";

            switch($orderstate){
                case SPN_STATE_PICKUP_DONE: 
                    $updatefield = "PICKUP_DONE";
                    break;
                case SPN_STATE_WAREHOUSE_WAIT: 
                    $updatefield = "WAREHOUSE_WAIT";
                    break;
                case SPN_STATE_WAREHOUSE_IN: 
                    $updatefield = "WAREHOUSE_IN";
                    break;
                case SPN_STATE_WAREHOUSE_OUT: 
                    $updatefield = "WAREHOUSE_OUT";
                    break;
                case SPN_STATE_SHIPPING_DEPATURE: 
                    $updatefield = "SHIPPING_DEPATURE";
                    break;
                case SPN_STATE_SHIPPING_ARRIVAL: 
                    $updatefield = "SHIPPING_ARRIVAL";
                    break;
                case SPN_STATE_SHIPPING_CUSTOMS: 
                    $updatefield = "SHIPPING_CUSTOMS";
                    break;
                case SPN_STATE_SHIPPING_CUSTOMS_CLEAR: 
                    $updatefield = "SHIPPING_CUSTOMS_CLEAR";
                    break;
                case SPN_STATE_SHIPPING_DELIVERY_START: 
                    $updatefield = "SHIPPING_DELIVERY_START";
                    break;
                case SPN_STATE_SHIPPING_DELIVERY_DONE: 
                    $updatefield = "SHIPPING_DELIVERY_DONE";
                    break;
                case SPN_STATE_CANCEL: 
                    $updatefield = "cancel";
                    $comment = 1;
                    break;
            }

            if(strlen($updatefield) > 0) {
                try {
                    $count = $this->trackingRepository
                    ->where("orderno", $orderno)
                    ->update([$updatefield => $comment]);
    
                    return $count;
                } catch (ValidatorException $e) {
                    echo $e;
                    return -1;
                }
            }
        } else {
            return -2;
        }
    }

    /**
     * Display a listing of the Order.
     * GET|HEAD /TrackingAPIController
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function trackingShipping(Request $request)
    {
        $orderno = $request->get("orderno"); 
        $regno = $request->get("regno");

        if(strlen($orderno) > 0 && strlen($regno) > 0) {
            try {

                $response = $this->procClient("etomars", $orderno, $regno);

                if($response != null && $response->getStatusCode() == 200) {
                    $result = $this->trackingResultParse("etomars", $orderno, $regno, $response);
    
                    return $this->sendResponse($result,'Contract retrieved successfully' );
                }
                return $this->sendError("server error : ".$response->getStatusCode());

            } catch (ValidatorException $e) {
                echo $e;
                return $this->sendError($e->getMessage());
            }
        } else {
            return $this->sendError("invalid param");
        }
    }

    public function procClient($shippingcomp, $orderno, $regno) {
        switch(strtoupper($shippingcomp)){
            case "ETOMARS": 
                {
                    $regNoList = [$regno];
                    //$regNoList = array('RegNoList' => $regno);

                    $body['ApiKey'] = $this->etomars_key;
                    $body['Type'] = "regno";
                    $body['RegNoList'] = $regNoList;

                    $client = new HttpClient([
                        'defaults' => ['verify' => false],
                        'headers' => [ 'Content-Type' => 'application/json' ]
                        ]);
                                    
                    return $client->post($this->request_tracking_etomars, array('body' => json_encode($body)));
                }
                break;
        }

        return null;

        //$body = ['ApiKey' => $this->etomars_key, 'Type' => 'regno', 'RegNoList' => $searchOrders];

    }
    
    public function trackingResultParse($shippingcomp, $orderno, $regno, $response) {

//        $trackingResult = "";
        $trackingShipping = "";
        $trackingPickup = "";

        switch(strtoupper($shippingcomp)){
            case "ETOMARS":
                $trackingShipping = $this->trackingParse_etomars($response);
                break;
        }

        $trackingPickup = $this->getPickupInfo($orderno);

        if($trackingPickup == null){
            $trackingPickup = [];
        }

        $trackingResult['PickupList'] = $trackingPickup;
        $trackingResult['TrackingList'] = $trackingShipping;


       return $trackingResult;
    }
    
    public function trackingParse_etomars($response) {
        //$result = array();

        $result;

        $etomarsResult = json_decode($response->getBody(), true);

        if($etomarsResult != null && $etomarsResult['Data'] != null) {
            $etomarsResultCnt = count($etomarsResult['Data']);

            if( $etomarsResultCnt > 0 ) {
                $shippingListCnt = count($etomarsResult['Data'][0]['TrackingList']);
                $shippingList = array();

                for($index = 0; $index < $shippingListCnt; $index++) {
                    array_push($shippingList, array('Status' => $etomarsResult['Data'][0]['TrackingList'][$index]['Status'], 
                        'StatusDesc' => json_encode($etomarsResult['Data'][0]['TrackingList'][$index]['StatusDesc'], JSON_UNESCAPED_UNICODE),
                        'IssueDateTime' => json_encode($etomarsResult['Data'][0]['TrackingList'][$index]['IssueDateTime'], JSON_UNESCAPED_UNICODE),
                        'IssueDetail' => json_encode($etomarsResult['Data'][0]['TrackingList'][$index]['IssueDetail'], JSON_UNESCAPED_UNICODE),
                        'Location' => json_encode($etomarsResult['Data'][0]['TrackingList'][$index]['Location'], JSON_UNESCAPED_UNICODE),
                        ));

                        /*
                    echo $etomarsResult['Data'][$index]['Zipcode'];
                    echo $etomarsResult['Data'][$index]['ProvName'];
                    echo $etomarsResult['Data'][$index]['CityName'];
                    echo $etomarsResult['Data'][$index]['CountyName']."\n";
                    */
                }

                $result['Status'] = $etomarsResult['Data'][0]['Status'];
                $result['StatusDesc'] = json_encode($etomarsResult['Data'][0]['StatusDesc'], JSON_UNESCAPED_UNICODE);
                $result['ShippingList'] = $shippingList;

                //array_push($result, $summaryData);
            }
        }

        return $result;
    }

    public function getPickupInfo($orderno) {

        $search['orderno'] = $orderno;
        $search['active'] = 1;
        $search['pickup_request'] = 'Y';
        $colume = ['boxtype_real', 'pickup_fee_real','pickupStatus', 
                        'approvalDt', 'assignDt', 'pickUpDt', 'warehousingDt', 
                        'gatheredDt', 'cancelRequestDt', 'cancelDt', 'deliveryStatus',
                        'shipRegisterDt', 'shipStartingDt', 'shipCompleteDt', 
                        'pickerName', 'pickerMobile', 'pickerPictureURI',
                        'cancelRequestCode', 'cancelReason', 'errorCode', 'errorMessage',
                        'updated_at'];
    
        //Helpers::pre_r($orderno);

        /** @var Order $orderPickupRepository */
        if (!empty($this->orderPickupRepository)) {
            try {
                $result = $this->orderPickupRepository->findWhere($search, $colume);

                /*
                if($result->count() > 0) {
                    $pickupList = array();
                    $resultList = $result->toArray();

                    array_push($pickupList, array('Status' => $resultList[0]['TrackingList'][$index]['Status'], 
                    'StatusDesc' => json_encode($etomarsResult['Data'][0]['TrackingList'][$index]['StatusDesc'], JSON_UNESCAPED_UNICODE),
                    'IssueDateTime' => json_encode($etomarsResult['Data'][0]['TrackingList'][$index]['IssueDateTime'], JSON_UNESCAPED_UNICODE),
                    'IssueDetail' => json_encode($etomarsResult['Data'][0]['TrackingList'][$index]['IssueDetail'], JSON_UNESCAPED_UNICODE),
                    'Location' => json_encode($etomarsResult['Data'][0]['TrackingList'][$index]['Location'], JSON_UNESCAPED_UNICODE),
                    ));
                }
                */

                //Helpers::pre_r($result->count());

                return $result->toArray();
            } catch (RepositoryException $e) {
                //Helpers::pre_r($e);
                return null;
            }
        }
        
        return null;
    }
}
