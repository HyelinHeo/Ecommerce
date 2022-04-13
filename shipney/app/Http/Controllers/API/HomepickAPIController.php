<?php
/**
 * File name: OrderAPIController.php
 * Last modified: 2020.05.31 at 19:34:40
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\Http\Controllers\API;

use GuzzleHttp\Client as HttpClient;
use Dompdf\Helpers;

use App\Criteria\Orders\OrdersOfStatusesCriteria;
use App\Criteria\Orders\OrdersOfStatusesCriteriaArray;
use App\Criteria\Orders\OrdersOfUserCriteria;
use App\Events\OrderChangedEvent;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Notifications\NewOrder;
use App\Notifications\StatusChangedOrder;
use App\Repositories\NotificationRepository;
use App\Repositories\OrderRepository;
use App\Repositories\OrderPickupRepository;
use Braintree\Gateway;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;
use Prettus\Validator\Exceptions\ValidatorException;
use Stripe\Token;

/**
 * Class OrderController
 * @package App\Http\Controllers\API
 */
class HomepickAPIController extends Controller
{
    private $homepick_key = "tZPHKwJvFhmVtycxSGbJ";
    private $homepick_provider_code = "100108";
    private $homepick_url_getdata = "https://zm-ex-api.zoommaok.com/rest/v1/order/";
    private $homepick_url_regorder = "https://zm-ex-api.zoommaok.com/rest/v1/order/";
    
    /** @var  OrderRepository */
    private $orderRepository;

    /** @var  OrderPickupRepository */
    private $orderPickupRepository;
    
    /** @var  NotificationRepository */
    private $notificationRepository;

    /** @var  EtomarsAPIController */
    private $etomarsAPIController;

    /**
     * OrderAPIController constructor.
     * @param OrderRepository $orderRepo
     * @param NotificationRepository $notificationRepo
     */
    public function __construct(EtomarsAPIController $etomarsCtrl, OrderRepository $orderRepo, OrderPickupRepository $orderPickupRepo, NotificationRepository $notificationRepo)
    {
        $this->etomarsAPIController = $etomarsCtrl;
        $this->orderRepository = $orderRepo;
        $this->orderPickupRepository = $orderPickupRepo;
        $this->notificationRepository = $notificationRepo;
    }

    /**
     * Display a listing of the Order.
     * GET|HEAD /orders
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        /*
        try {
            $this->orderRepository->pushCriteria(new RequestCriteria($request));
            $this->orderRepository->pushCriteria(new LimitOffsetCriteria($request));
            $this->orderRepository->pushCriteria(new OrdersOfStatusesCriteria($request));
            //$this->orderRepository->pushCriteria(new OrdersOfUserCriteria(auth()->id()));
        } catch (RepositoryException $e) {
            return $this->sendError($e->getMessage());
        }
        $orders = $this->orderRepository->all();

        return $this->sendResponse($orders->toArray(), 'Orders retrieved successfully');
        */
        return $this->updateFromHomepickStatusData();
    }
    
    public function conversionStatusFromHomepick($homepickStatus) 
    {
        $shipneyStatus = -1;
        
        switch($homepickStatus) {
            case "RP":    // 접수완료
            case "AP":    // 피커확정
                $shipneyStatus = SPN_STATE_PICKUP_REG_DONE;                
                break;
            case "WD":    // 픽업완료
            case "GC":    // 택배사접수
                $shipneyStatus = SPN_STATE_PICKUP_DONE;
                break;
            case "CR":   // 취소요청
                //$shipneyStatus = SPN_STATE_CANCEL_REQ;
                //break;
            case "CD":   // 취소완료
                $shipneyStatus = SPN_STATE_CANCEL;
                break;
            case "TR":   // 택배사 터미널 입고
            case "SS":   // 배송 중
                $shipneyStatus = SPN_STATE_PICKUP_DELIVERY;
                break;
            case "SE":   // 배송완료
            case "SC":   // 매출확정
                $shipneyStatus = SPN_STATE_WAREHOUSE_WAIT;
                break;
        }

        return $shipneyStatus;
    }

    public function updateFromHomepickStatusData() 
    {
        $result_summary = '';
        $result_summary_start = date("Y-m-d H:i:s");
        $result_summary_error = '';
        $result_summary_order_cnt = 0;
        $result_summary_etomars_cnt = 0;
        $result_summary_not_matching_cnt = 0;
        $result_summary_not_reg_cnt = 0;

        $maxSendPoss = 1;
        $ordersCnt = 0;
        $checkedCnt = 0;
        $orders = $this->getOrderInfoPickupStateList();
        $ordersCnt = count($orders);

        //Helpers::pre_r($ordersCnt."<======");
        $result_summary_order_cnt = $ordersCnt;

        if( $ordersCnt > 0 ) {
            for($checkedCnt = 0; $checkedCnt < $ordersCnt; $checkedCnt++) { // 1개까지 보낼수 있다.
                $shipneyStatus = -1;

                $searchOrders = $orders[$checkedCnt]['pickupOrderNo'];

                if($searchOrders == null || strlen($searchOrders) < 1) {
                    //$shipneyStatus = SPN_STATE_ERROR; // error 설정을 한다. error state 삭제
                    //$input['order_status_id'] = $shipneyStatus;
                    //$input['hint'] = '픽업주문번호누락';
                    //$this->updatePickupInfoData($orders[$checkedCnt]['id'], $input, $orders[$checkedCnt]['orderno'], null);

                    $result_summary_not_matching_cnt++; 

                    $this->orderRepository->updateOrderAccident($orders[$checkedCnt]['id'], 
                                               $orders[$checkedCnt]['accident_code'], 
                                               $orders[$checkedCnt]['accident_desc'], 
                                               SPN_ACCIDENT_PICKUP_ORDERNO);
                } else {
                    Helpers::pre_r($searchOrders);
                    //Helpers::pre_r($searchOrders);
                    
                    $client = new HttpClient([
                        'defaults' => ['verify' => false],
                        'headers' => [ 
                            'Content-Type' => 'application/json',
                            'authorization' => $this->homepick_key,
                            'Provider' => 'partner',
                            'ProviderCode' => $this->homepick_provider_code,
                             ]
                        ]);
            
                    $hompickRequestUrl = $this->homepick_url_getdata.$searchOrders;
                    //Helpers::pre_r($hompickRequestUrl);
    
                    $response = $client->get($hompickRequestUrl);
            
                    if($response->getStatusCode() == 200) {
                        //Helpers::pre_r($this->getOrderInfoList_updateFromEtomarsStatusData());
        
                        $homepickResult = json_decode($response->getBody(), true);
                        //Helpers::pre_r($homepickResult);
    
                        if($homepickResult['data'] != null) {
                            $homepickStatus = $homepickResult['data']['order']['orderStatus'];

                            $result_summary_etomars_cnt += 1;
    
                            $shipneyStatus = $this->conversionStatusFromHomepick($homepickStatus) ;
                            if($shipneyStatus > -1 ) {

                                // cancel 처리의 경우
                                if($shipneyStatus == SPN_STATE_CANCEL || $orders[$checkedCnt]['order_status_id'] == SPN_STATE_CANCEL) 
                                {
                                    $this->updatePickupInfoData($orders[$checkedCnt]['orderno'], $homepickResult['data']);

                                    // 사용자는 취소처리 하지 않고 pickup System에서 취소 처리를 하였음.
                                    if($orders[$checkedCnt]['order_status_id'] != SPN_STATE_CANCEL) 
                                    {
                                        $this->orderRepository->updateOrderAccident($orders[$checkedCnt]['id'], 
                                                                   $orders[$checkedCnt]['accident_code'], 
                                                                   $orders[$checkedCnt]['accident_desc'], 
                                                                   SPN_ACCIDENT_CANCLE_BY_PICKUP);
                                    }
                                } else {
                                    // 현재의 상태설정과 비교하여, 차이가 있는 경우 변경을 한다. 수천개의 경우에는 아래의 루프는 심각한 문제가 될 것으로 보인다.
                                    if($shipneyStatus != $orders[$checkedCnt]['order_status_id'] ) {
                                        if($orders[$checkedCnt]['order_status_id'] < SPN_STATE_WAREHOUSE_WAIT ) {  // 4 이하는 픽업관련 상태이다. 이경우는 etomars의 상태와는 다르다.
                                            //Helpers::pre_r($shipneyStatus."<======");
                                            $result_summary_not_matching_cnt++; 
                                            $orders[$checkedCnt]['order_status_id'] = $shipneyStatus;

                                            $input = null;
                                            $input['order_status_id'] = $shipneyStatus;
                                            $input['hint'] = '';

                                            $pickupOrderNo = $orders[$checkedCnt]['pickupOrderNo'];

                                            if($orders[$checkedCnt]['regno'] == null || strlen($orders[$checkedCnt]['regno']) < 1) {
                                                $EtomarsRegNo = $this->etomarsAPIController->regOrderToEtomars($orders[$checkedCnt], $pickupOrderNo);
                                                $input['regno'] = $EtomarsRegNo;
                                            }
                                            
                                            $this->updateOrderInfoData($orders[$checkedCnt]['id'], $input);
                                            $this->updatePickupInfoData($orders[$checkedCnt]['orderno'], $homepickResult['data']);
                                        }
                                    }
                                }
                            }
                        } else {
                            //Helpers::pre_r("error! not found in homepick system");
                            // 미등록 상태
                            //$shipneyStatus = SPN_STATE_ERROR; // error 설정을 한다. error state 삭제

                            //$input['order_status_id'] = $shipneyStatus;
                            //$input['hint'] = '픽업주문번호누락';
                            //$this->updatePickupInfoData($orders[$checkedCnt]['id'], $input, $orders[$checkedCnt]['orderno'], null);
                            $result_summary_not_matching_cnt++; 

                            $this->orderRepository->updateOrderAccident($orders[$checkedCnt]['id'], 
                                                       $orders[$checkedCnt]['accident_code'], 
                                                       $orders[$checkedCnt]['accident_desc'], 
                                                       SPN_ACCIDENT_PICKUP_ORDERNO);
                        }
                    } else {
                        $result_summary_error += " ".$response->getStatusCode();
                    }
                }
            }
        }

        $result_summary_end = date("Y-m-d H:i:s");

        $result_summary_duration = $result_summary_start." ~ ".$result_summary_start;

        $result_summary = "[".$result_summary_duration."]"."[ST:".$result_summary_order_cnt."][ET:".$result_summary_etomars_cnt."][UPDATE:".$result_summary_not_matching_cnt."][NOTREG:".$result_summary_not_reg_cnt."][ERROR:".$result_summary_error."]\n";
        return $result_summary;
    }

    public function updateOrderInfoData($id, $input) 
    {
        try {
            $order = $this->orderRepository->update($input, $id);
            if (setting('enable_notifications', false)) {
                // 낮시간에만 보낼수 있도록 해야한다. table하나에 넣고, 그것을 낮시간에 처리하는 방식을 고려해야함.
                if (isset($input['order_status_id'])) {
                    //Helpers::pre_r("do notification <======".$order->user);
                    Notification::send([$order->user], new StatusChangedOrder($order, ""));
                }
            }
        } catch (ValidatorException $e) {
            //Helpers::pre_r($e);
            Flash::error($e->getMessage());
        }        
    }

    public function updatePickupInfoData($orderno, $pickupinfo) 
    {
        try {
            $order_pickup = array();
            $order_pickup['pickupOrderNo'] = $pickupinfo['order']['orderNo'];
            $order_pickup['pickupStatus'] = $pickupinfo['order']['orderStatus'];
            $order_pickup['pickup_reserve'] = $pickupinfo['order']['pickReserveDt'];

            $order_pickup['approvalDt'] = $pickupinfo['Delivery']['approvalDt'];
            $order_pickup['assignDt'] = $pickupinfo['Delivery']['assignDt'];
            $order_pickup['pickUpDt'] = $pickupinfo['Delivery']['pickUpDt'];
            $order_pickup['warehousingDt'] = $pickupinfo['Delivery']['warehousingDt'];
            $order_pickup['gatheredDt'] = $pickupinfo['Delivery']['gatheredDt'];
            $order_pickup['cancelRequestDt'] = $pickupinfo['Delivery']['cancelRequestDt'];
            $order_pickup['cancelDt'] = $pickupinfo['Delivery']['cancelDt'];
            $order_pickup['invoiceNumber'] = $pickupinfo['Delivery']['invoiceNumber'];

            $order_pickup['deliveryCode'] = $pickupinfo['Delivery']['deliveryCode'];
            $order_pickup['deliveryStatus'] = $pickupinfo['Delivery']['deliveryStatus'];
            $order_pickup['shipRegisterDt'] = $pickupinfo['Delivery']['shipRegisterDt'];
            $order_pickup['shipStartingDt'] = $pickupinfo['Delivery']['shipStartingDt'];
            $order_pickup['shipCompleteDt'] = $pickupinfo['Delivery']['shipCompleteDt'];
            $order_pickup['pickerName'] = $pickupinfo['Delivery']['pickerName'];
            $order_pickup['pickerMobile'] = $pickupinfo['Delivery']['pickerMobile'];
            $order_pickup['pickerPictureURI'] = $pickupinfo['Delivery']['pickerPictureURI'];
            $order_pickup['orderMemo'] = $pickupinfo['Delivery']['orderMemo'];
            $order_pickup['cancelRequestCode'] = $pickupinfo['Delivery']['cancelRequestCode'];
            $order_pickup['cancelReason'] = $pickupinfo['Delivery']['cancelRequestReason'];

            //Helpers::pre_r($order_pickup);
            $this->orderPickupRepository->updateOrCreate(['orderno' => $orderno], $order_pickup);
        } catch (ValidatorException $e) {
            //Helpers::pre_r($e);
            Flash::error($e->getMessage());
        }        
    }
    
    // 픽업 상태 변경을 위한 상태 수집
    public function getOrderInfoPickupStateList() 
    {
        try {
            //$request = new Request();
            //$status = json_encode(['statuses' => $arr]);
           // $request->setJson($status);
            //$this->orderRepository->pushCriteria(new RequestCriteria($request));

            $state = array(SPN_STATE_PICKUP_REG_DONE, 
                         SPN_STATE_PICKUP_DONE, 
                         SPN_STATE_CANCEL, 
                         SPN_STATE_PICKUP_DELIVERY);

            $model = $this->orderRepository->findWhereIn('order_status_id', $state);

            return $model->toArray();
        } catch (RepositoryException $e) {
            Flash::error($e->getMessage());
            return [];
        }

        //$orders = $this->orderRepository->all(['id','order_status_id','orderno','pickupOrderNo']);
                
        return [];
    }

    public function regOrderToHomepick($shipneyOrder) 
    {
        try {
            $senderInfo['senderZonecode'] = $shipneyOrder['pickup_post_num'];
            $senderInfo['senderName'] = $shipneyOrder['sender_name'];
            $senderInfo['senderPhone'] = $shipneyOrder['sender_phone'];
            $senderInfo['senderAddr1'] = $shipneyOrder['pickup_address_01'];
            $senderInfo['senderAddr2'] = $shipneyOrder['pickup_address_02'];
            $senderInfo['senderAddrBname'] = '';
            $senderInfo['pickReserveDt'] = $shipneyOrder['pickup_reserve'];
            $senderInfo['senderSex'] = '';
            $senderInfo['senderAge'] = 1;
            $senderInfo['payType'] = 'C';
            
            $itemInfo[0]['orderSequence'] = 1;
            $itemInfo[0]['receiverZonecode'] = "10049";
            $itemInfo[0]['receiverName'] = "김정호";
            $itemInfo[0]['receiverPhone'] = "070-7715-1930";
            $itemInfo[0]['receiverAddr1'] = "경기도 김포시 양촌읍 고음달로";
            $itemInfo[0]['receiverAddr2'] = "174-25";
            $itemInfo[0]['receiverAddrBname'] = '';
            
            $itemInfo[0]['boxType'] = $shipneyOrder['boxtype'];
            $itemInfo[0]['boxEa'] = 1;
            $itemInfo[0]['packageYN'] = 'N';
            $itemInfo[0]['prodName'] = $shipneyOrder['item_main_name'];
            $itemInfo[0]['prodPrice'] = $shipneyOrder['item_total_price'];
            $itemInfo[0]['deliveryRequest'] = '';
            $itemInfo[0]['partnerOrderNo'] = $shipneyOrder['orderno'];
            $itemInfo[0]['partnerInvoiceNo'] = '';
            $itemInfo[0]['partnerMemo'] = '쉽니 배송상품';

            $data['order'] = $senderInfo;
            $data['Detail'] = $itemInfo;

            $client = new HttpClient([
                'defaults' => ['verify' => false],
                'headers' => [ 
                    'Content-Type' => 'application/json',
                    'authorization' => $this->homepick_key,
                    'Provider' => 'partner',
                    'ProviderCode' => $this->homepick_provider_code,
                    ]
                ]);

            $hompickRequestUrl = $this->homepick_url_regorder;

            //Helpers::pre_r($hompickRequestUrl);
            //Helpers::pre_r(json_encode($data));

            $jsondata = json_encode($data);

            $response = $client->post($hompickRequestUrl, array('body' => utf8_encode($jsondata)));

            $retVal['success'] = false;
            
            if($response->getStatusCode() == 200) {
                //Helpers::pre_r($this->getOrderInfoList_updateFromEtomarsStatusData());

                $homepickResult = json_decode($response->getBody(), true);
                //Helpers::pre_r($etomarsResult);

                if($homepickResult['success'] == true) {
                    $retVal['data']['orderNo'] = $homepickResult['data'][0]['orderNo']; 
                    $retVal['data']['orderStatus'] = $homepickResult['data'][0]['orderStatus']; 
                    $retVal['data']['deliveryCode'] = $homepickResult['data'][0]['deliveryCode']; 
                    $retVal['data']['boxType'] = $homepickResult['data'][0]['boxType']; 
                    $retVal['data']['addFare'] = $homepickResult['data'][0]['addFare']; 
                    $retVal['data']['amount'] = $homepickResult['data'][0]['amount']; 
                    $retVal['data']['totalAmount'] = $homepickResult['data'][0]['totalAmount']; 
                    $retVal['errorCode'] = "";
                    $retVal['errorMessage'] = "";
                } else {
                    $retVal['errorCode'] =  $homepickResult['errorResult']['errorCode'];
                    $retVal['errorMessage'] =  $homepickResult['errorResult']['errorMessage'];
                }

                $retVal['success'] = $homepickResult['success'];
            } 

            /*
            $responseBody = $response->getBody();

            //Helpers::pre_r($responseBody);
            //$joblogfile = fopen("datasync_homepick.log", "a+");
            $joblogfile = fopen("datasync_homepick.html", "w");
            fwrite($joblogfile, $responseBody);
            fclose($joblogfile);
            */

            return $retVal;

        } catch(Exception $e) {
            //Helpers::pre_r($responseBody);
            $joblogfile = fopen("reg_homepick_error.log", "a+");
            //$joblogfile = fopen("reg_homepick_error.html", "w");
            fwrite($joblogfile, $e->getMessage());
            fclose($joblogfile);

            $retVal['success'] = false;
            return $retVal;
        }
    }
    /**
     * Display the specified Order.
     * GET|HEAD /orders/{id}
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $id)
    {
    }

    /**
     * Store a newly created Order in storage.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
    }

    /**
     * Update the specified Order in storage.
     *
     * @param int $id
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, Request $request)
    {
    }
}
