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
use Illuminate\Support\Facades\Notification;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class ZipcodeAddressAPIController
 * @package App\Http\Controllers\API
 */
class ZipcodeAddressAPIController extends Controller
{
    private $etomars_key = "37fa5f9c16894b8184cdc1f04";
    private $request_url_jp = "https://asp4.cj-soft.co.jp/SWebServiceComm/services/CommService/getAddr";
    private $request_url_cn = "https://cbt.shipnergy.com/apiv2/SearchZipcodeCn";
    private $request_url_us = "https://cbt.shipnergy.com/apiv2/SearchZipcodeUs";


    /**
     * ZipcodeAddressAPIController constructor.
     */
    public function __construct()
    {
    }

    /**
     * Display a listing of the Order.
     * GET|HEAD /orders
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchAddress(Request $request)
    {
        $nation = $request->get("nation");
        $zipcode = $request->get("zipcode");

        if(strlen($nation) > 0 && strlen($zipcode) >0) {
            try {

                $response = $this->procClient($nation, $zipcode);

                if($response != null && $response->getStatusCode() == 200) {
                    $result = $this->zipcodeResultParse($nation, $response);
    
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

    public function procClient($nation, $zipcode) {
        switch(strtoupper($nation)){
            case "JP": 
                {
                    $request_url = $this->request_url_jp."?zipcode=".$zipcode;

                    $client = new HttpClient([
                        'defaults' => ['verify' => false],
                        'headers' => [
                            'Accept' => 'application/xml'
                            //'Content-Type' => 'application/xml'                        
                        ]
                    ]);
            
                    return $client->get($request_url);
                }
                break;
            case "CN":
                {
                    $client = new HttpClient([
                        'defaults' => ['verify' => false],
                        'headers' => [
                            'Accept' => 'application/xml'
                            //'Content-Type' => 'application/xml'                        
                        ]
                    ]);

                    $body = ['ApiKey' => $this->etomars_key, 'Zipcode' => $zipcode];

                    return $client->post($this->request_url_cn, array('body' => json_encode($body)));
                }
                break;
            case "US":
                {
                    $client = new HttpClient([
                        'defaults' => ['verify' => false],
                        'headers' => [
                            'Accept' => 'application/xml'
                            //'Content-Type' => 'application/xml'                        
                        ]
                    ]);

                    $body = ['ApiKey' => $this->etomars_key, 'Zipcode' => $zipcode];

                    return $client->post($this->request_url_us, array('body' => json_encode($body)));
                }
                break;
        }

        return null;

        //$body = ['ApiKey' => $this->etomars_key, 'Type' => 'regno', 'RegNoList' => $searchOrders];

    }

    public function zipcodeResultParse($nation, $response) {

        $jsonresult = "";

        switch(strtoupper($nation)){
            case "JP":
                $jsonresult = $this->zipcodeParse_jp($response);
                break;
            case "CN":
                $jsonresult = $this->zipcodeParse_cn($response);
                break;
            case "US":
                $jsonresult = $this->zipcodeParse_us($response);
                break;

        }


       return $jsonresult;
    }

    public function zipcodeParse_jp($response) {

        $xml = simplexml_load_string($response->getBody()->getContents());

        $data = $xml->xpath('ns:return');
        $result = array();
        
        if( $data !=null) {
            for( $i = 0; $i < count($data); $i++) {
                $lastChar = substr($data[$i], -1);
                if($lastChar == "0" || $lastChar == "3") {
                    $jbexplode = explode('|', $data[$i] );
                    if(count($jbexplode) == 3) {
                        if($lastChar == "3") {
                            $inner = explode(',', $jbexplode[1] );
                            for($j = 0; $j < count($inner); $j++) {
                                array_push($result,array('zipcode' => $jbexplode[0],'address1' => json_encode($inner[$j], JSON_UNESCAPED_UNICODE)));
                            }
                        } else {
                            array_push($result, array('zipcode' => $jbexplode[0], 'address1' => json_encode($jbexplode[1], JSON_UNESCAPED_UNICODE)));
                            //echo $jbexplode[1];
                            //echo json_encode($jbexplode[1], JSON_UNESCAPED_UNICODE);
                        }
                    }
                }
            }
        }

       return  $result;
    }

    public function zipcodeParse_cn($response) {
        $result = array();

        $etomarsResult = json_decode($response->getBody(), true);

        if($etomarsResult != null && $etomarsResult['Data'] != null) {
            $etomarsResultCnt = count($etomarsResult['Data']);

            if( $etomarsResultCnt > 0 ) {

                for($index = 0; $index < $etomarsResultCnt; $index++) {
                    array_push($result, array('zipcode' => $etomarsResult['Data'][$index]['Zipcode'], 
                        'address1' => json_encode($etomarsResult['Data'][$index]['ProvName'], JSON_UNESCAPED_UNICODE),
                        'address2' => json_encode($etomarsResult['Data'][$index]['CityName'], JSON_UNESCAPED_UNICODE),
                        'address3' => json_encode($etomarsResult['Data'][$index]['CountyName'], JSON_UNESCAPED_UNICODE),
                        ));

                        /*
                    echo $etomarsResult['Data'][$index]['Zipcode'];
                    echo $etomarsResult['Data'][$index]['ProvName'];
                    echo $etomarsResult['Data'][$index]['CityName'];
                    echo $etomarsResult['Data'][$index]['CountyName']."\n";
                    */
                }
            }
        }

        return $result;
    }
    
    public function zipcodeParse_us($response) {
        $result = array();

        $etomarsResult = json_decode($response->getBody(), true);

        if($etomarsResult != null && $etomarsResult['Data'] != null) {
            $etomarsResultCnt = count($etomarsResult['Data']);

            if( $etomarsResultCnt > 0 ) {

                for($index = 0; $index < $etomarsResultCnt; $index++) {
                    array_push($result, array('zipcode' => $etomarsResult['Data'][$index]['Zipcode'], 
                        'address1' => json_encode($etomarsResult['Data'][$index]['StateMin'], JSON_UNESCAPED_UNICODE),
                        'address2' => json_encode($etomarsResult['Data'][$index]['StateName'], JSON_UNESCAPED_UNICODE),
                        'address3' => json_encode($etomarsResult['Data'][$index]['CityName'], JSON_UNESCAPED_UNICODE),
                        ));

                        /*
                    echo $etomarsResult['Data'][$index]['Zipcode'];
                    echo $etomarsResult['Data'][$index]['ProvName'];
                    echo $etomarsResult['Data'][$index]['CityName'];
                    echo $etomarsResult['Data'][$index]['CountyName']."\n";
                    */
                }
            }
        }

        return $result;
    }
}
