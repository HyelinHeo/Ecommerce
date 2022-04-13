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

use App\Http\Controllers\Controller;
use Braintree\Gateway;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Models\IslandArea;
use App\Repositories\IslandAreaRepository;

/**
 * Class PickupAPIController
 * @package App\Http\Controllers\API
 */
class PickupAPIController extends Controller
{
    private $homepick_key = "tZPHKwJvFhmVtycxSGbJ";
    private $homepick_code = "100108";
    private $homepick_base_url = "https://zm-ex-api.zoommaok.com";
    private $homepick_req_url_support_area = "/rest/v1/support/";
    private $homepick_req_url_visitable_date = "/rest/v1/support/visitable-times";

    /** @var  islandAreaRepository */
    private $islandAreaRepository;

    /**
     * PickupAPIController constructor.
     */
    public function __construct(IslandAreaRepository $islandAreaRepo)
    {
        parent::__construct();
        $this->islandAreaRepository = $islandAreaRepo;
    }

    public function pickupSupportAreaLocal(Request $request)
    {
        try{
            $this->islandAreaRepository->pushCriteria(new RequestCriteria($request));

            $islandArea = $this->islandAreaRepository->all();

            if (count($islandArea) > 0) {
                $result['pickup_type'] = 'C';
                $result['nation'] = $islandArea[0]['nation'];
                $result['jeju'] = $islandArea[0]['jeju'];
                $result['island'] = $islandArea[0]['island'];
                    
                return $this->sendResponse($result, 'aread retrieved successfully');
            } else {
                $result['pickup_type'] = 'D';
                $result['nation'] = '';
                $result['jeju'] = 'N';
                $result['island'] = 'N';
                return $this->sendResponse($result, 'aread retrieved successfully');
            }     

        } catch (RepositoryException $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendError("fault");
    }

    public function pickupSupportArea(Request $request)
    {
        $nation = $request->get("nation");
        $zipcode = $request->get("zipcode");

        if(strlen($nation) > 0 && strlen($zipcode) > 0) {
            try {

                $response = $this->procClientSupportArea($nation, $zipcode);

                if($response == null) {
                    $result["success"] = false;
                    return $this->sendResponse($result,'not support area' );
                }

                if($response->getStatusCode() == 200) {
                    $result = $this->supportAreaResultParse($nation, $response);

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

    public function procClientSupportArea($nation, $zipcode) {
        switch(strtoupper($nation)){
            case "KR": 
                {
                    $request_url = $this->homepick_base_url.$this->homepick_req_url_support_area.$zipcode;

                    $client = new HttpClient([
                        'defaults' => ['verify' => false],
                        'headers' => [
                            'Content-Type' => 'application/xml',
                            'Authorization' => $this->homepick_key,
                            'Provider' => 'partner',
                            'ProviderCode' => $this->homepick_code
                        ]
                    ]);
            
                    return $client->get($request_url);
                }
                break;
            default:
                break;
        }

        return null;

        //$body = ['ApiKey' => $this->etomars_key, 'Type' => 'regno', 'RegNoList' => $searchOrders];

    }

    public function supportAreaResultParse($nation, $response) {
        $result = "";

        switch(strtoupper($nation)){
            case "KR":
                $result = $this->supportAreaParse_ko($response);
                break;
        }

       return $result;
    }

    //enum MpxPickupType { NONE, PICKUP_DAILY, PICKUP_TIME, PICKUP_NORMAL, PICKUP_NOT_SUPPORT }
    public function supportAreaParse_ko($response) {
        $resultOK = false;
        //$result = "";

        $supportAreaResult = json_decode($response->getBody(), true);

        //return $supportAreaResult;

        if($supportAreaResult != null && $supportAreaResult['success'] == true) {
            $resultCnt = count($supportAreaResult['data']);

            if( $resultCnt > 0 ) {
                $result_data['pickup_type'] = $supportAreaResult['data']['pickup_type'];
                $result_data['jeju'] = $supportAreaResult['data']['jeju'];
                $result_data['island'] = $supportAreaResult['data']['island'];
                    
                $resultOK = true;
                $result['success'] = true;
                $result["data"] = $result_data;
            }
        } else {
            // save log
        }

        $result["success"] = $resultOK;

        return $result;
    }

    public function pickupVisitableDate(Request $request)
    {
        $nation = $request->get("nation");
        $zipcode = $request->get("zipcode");

        if(strlen($nation) > 0 && strlen($zipcode) > 0) {
            try {

                $response = $this->procClientVisitableDate($nation, $zipcode);

                if($response == null) {
                    $result["success"] = false;
                    return $this->sendResponse($result,'not support area' );
                }

                if($response->getStatusCode() == 200) {
                    $result = $this->visitaleDateResultParse($nation, $response);

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

    public function procClientVisitableDate($nation) {
        switch(strtoupper($nation)){
            case "KR": 
                {
                    $request_url = $this->homepick_base_url.$this->homepick_req_url_visitable_date;

                    $client = new HttpClient([
                        'defaults' => ['verify' => false],
                        'headers' => [
                            'Content-Type' => 'application/xml',
                            'Authorization' => $this->homepick_key,
                            'Provider' => 'partner',
                            'ProviderCode' => $this->homepick_code
                        ]
                    ]);
            
                    return $client->get($request_url);
                }
                break;
            default:
                break;
        }

        return null;
    }

    public function visitaleDateResultParse($nation, $response) {
        $result = "";

        switch(strtoupper($nation)){
            case "KR":
                $result = $this->visitableDateParse_ko($response);
                break;
        }

       return $result;
    }

    public function visitableDateParse_ko($response) {
        $resultOK = false;
        //$result = "";

        $visitableDateResult = json_decode($response->getBody(), true);

        return $visitableDateResult;

        if($visitableDateResult != null && $visitableDateResult['success'] == true) {
            $resultCnt = count($visitableDateResult['data']);

            for($index = 0; $index < $resultCnt; $index++) {

                $date = $visitableDateResult['Data'][$index]['date'];
                $times = $visitableDateResult['Data'][$index]['time'];

                if($times != null ) {
                    $timeCnt = count($times);
                }

                array_push($result, array('date' => $visitableDateResult['Data'][$index]['date'], 
                    'address1' => json_encode($visitableDateResult['Data'][$index]['StateMin'], JSON_UNESCAPED_UNICODE),
                    'address2' => json_encode($visitableDateResult['Data'][$index]['StateName'], JSON_UNESCAPED_UNICODE),
                    'address3' => json_encode($visitableDateResult['Data'][$index]['CityName'], JSON_UNESCAPED_UNICODE),
                    ));

                    /*
                echo $etomarsResult['Data'][$index]['Zipcode'];
                echo $etomarsResult['Data'][$index]['ProvName'];
                echo $etomarsResult['Data'][$index]['CityName'];
                echo $etomarsResult['Data'][$index]['CountyName']."\n";
                */
            }


            if( $resultCnt > 0 ) {
                $result_data['pickup_type'] = $supportAreaResult['data']['pickup_type'];
                $result_data['jeju'] = $supportAreaResult['data']['jeju'];
                $result_data['island'] = $supportAreaResult['data']['island'];
                    
                $resultOK = true;
                $result['success'] = true;
                $result["data"] = $result_data;
            }
        } else {
            // save log
        }

        $result["success"] = $resultOK;

        return $result;
    }
}
