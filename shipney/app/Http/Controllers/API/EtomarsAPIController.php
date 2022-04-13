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
use App\Criteria\Products\ProductsOfOrderCriteria;
use App\Events\OrderChangedEvent;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Notifications\NewOrder;
use App\Notifications\StatusChangedOrder;
use App\Repositories\NotificationRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
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
class EtomarsAPIController extends Controller
{
    private $etomars_key = "37fa5f9c16894b8184cdc1f04";
    private $etomars_url_getstatus = "https://cbt.shipnergy.com/apiv2/GetShippingStatus";
    private $etomars_url_getdata = "https://cbt.shipnergy.com/apiv2/GetData";
    private $etomars_url_regorder = "https://cbt.shipnergy.com/apiv2/RegData";

    /** @var  OrderRepository */
    private $orderRepository;
    /** @var  ProductRepository */
    private $productRepository;

    /**
     * OrderAPIController constructor.
     * @param OrderRepository $orderRepo
     * @param ProductRepository $productRepository
     * @param NotificationRepository $notificationRepo
     */
    public function __construct(OrderRepository $orderRepo, ProductRepository $productRepo)
    {
        $this->orderRepository = $orderRepo;
        $this->productRepository = $productRepo;
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
        return $this->updateFromEtomarsStatusData();
    }
    
    public function conversionStatusFromEtomars($etomarsStatus) 
    {
        $shipneyStatus = 0;
        
        switch($etomarsStatus) {
            case 10:    // 입고대기
                // Etomars에서는 입고대기 일 수 있으나, 픽업을 요청한 경우, 픽업 상태이므로 이련경우 수정을 하지 않도록.
                $shipneyStatus = SPN_STATE_WAREHOUSE_WAIT;                
                break;
            case 15:    // 픽업완료
                $shipneyStatus = SPN_STATE_WAREHOUSE_WAIT;
                break;
            case 20:    // 입고완료
                $shipneyStatus = SPN_STATE_WAREHOUSE_IN;
                break;
            case 30:    // 출고완료
                $shipneyStatus = SPN_STATE_WAREHOUSE_OUT;
                break;
            case 100:   // 항공기 출발
                $shipneyStatus = SPN_STATE_SHIPPING_DEPATURE;
                break;
            case 200:   // 항공기 도착
                $shipneyStatus = SPN_STATE_SHIPPING_ARRIVAL;
                break;
            case 300:   // 통관진행중
                $shipneyStatus = SPN_STATE_SHIPPING_CUSTOMS;
                break;
            case 400:   // 통관완료
                $shipneyStatus = SPN_STATE_SHIPPING_CUSTOMS_CLEAR;
                break;
            case 500:   // 배송시작
                $shipneyStatus = SPN_STATE_SHIPPING_DELIVERY_START;
                break;
            case 550:   // 배송중
                $shipneyStatus = SPN_STATE_SHIPPING_DELIVERY;
                break;
            case 600:   // 반송완료
                $shipneyStatus = SPN_STATE_RETURN_DONE;
                break;
            case 700:   // 배송완료
                $shipneyStatus = SPN_STATE_SHIPPING_DELIVERY_DONE;
                break;
        }
        return $shipneyStatus;
    }

    public function updateFromEtomarsStatusData() 
    {
        $result_summary = '';
        $result_summary_start = date("Y-m-d H:i:s");
        $result_summary_error = '';
        $result_summary_order_cnt = 0;
        $result_summary_etomars_cnt = 0;
        $result_summary_not_matching_cnt = 0;
        $result_summary_not_reg_cnt = 0;

        $maxSendPoss = 100;
        $ordersCnt = 0;
        $checkedCnt = 0;
        $orders = $this->getOrderInfoList_updateFromEtomarsStatusData();
        $ordersCnt = count($orders);

        $tempIndex = 0;
        $mergeIndex = 0;

        //Helpers::pre_r($ordersCnt."<======");
        $result_summary_order_cnt = $ordersCnt;

        if( $ordersCnt > 0 ) {
            while($checkedCnt < $ordersCnt) { // 100개까지 보낼수 있다.
                $searchOrders = array();

                for($tempIndex = 0; $tempIndex < $maxSendPoss; $tempIndex++) {
                    $mergeIndex = $tempIndex + $checkedCnt;

                    if($mergeIndex < $ordersCnt) {
                        $tempRegNo = $orders[$tempIndex + $checkedCnt]['regno'];
                        if($tempRegNo != null && strLen($tempRegNo) > 0 ) {
                            array_push($searchOrders, $orders[$tempIndex + $checkedCnt]['regno']);
                        }
                    } else {
                        $tempIndex++;
                        break;
                    }
                }
                $checkedCnt += $tempIndex;
                //Helpers::pre_r($searchOrders);
                
                $client = new HttpClient([
                    'defaults' => ['verify' => false],
                    'headers' => [ 'Content-Type' => 'application/json' ]
                    ]);
        
                $body = ['ApiKey' => $this->etomars_key, 'Type' => 'regno', 'RegNoList' => $searchOrders];
        
                //Helpers::pre_r(json_encode($body));
        
                $response = $client->post($this->etomars_url_getstatus, array('body' => json_encode($body)));
        
                //Helpers::pre_r((string) $response->getStatusCode());
                if($response->getStatusCode() == 200) {
                    //Helpers::pre_r($response->getBody());
    
                    $etomarsResult = json_decode($response->getBody(), true);
                    //Helpers::pre_r($etomarsResult);

                    if($etomarsResult != null && $etomarsResult['Data'] != null) {
                        $etomarsResultCnt = count($etomarsResult['Data']);
                        //Helpers::pre_r($etomarsResult);
    
                        $result_summary_etomars_cnt += $etomarsResultCnt;

                        if( $etomarsResultCnt > 0 ) {
                            $tempOrderId = -1;
                            $tempOrderStatus = -1;
                            $tempOrderRegNo = '';
        
                            $etomarsStatus = -1;
                            $etomarsRequestNo = '';

                            $errorCode = 0;
        
                            for($index = 0; $index < $etomarsResultCnt; $index++) {
                                $etomarsStatus = $etomarsResult['Data'][$index]['Status'];
                                $etomarsRequestNo = $etomarsResult['Data'][$index]['RequestNo'];
        
                                if($etomarsStatus < 0) {
                                    //Helpers::pre_r("error! not found in etomars system");
                                    //$shipneyStatus = SPN_STATE_ERROR; // error 설정을 한다. error state 삭제
                                    $errorCode = SPN_ACCIDENT_SHIPPING_ORDERNO;
                                    $result_summary_not_reg_cnt++;
                                } else {
                                    $shipneyStatus = $this->conversionStatusFromEtomars($etomarsStatus) ;
                                }
        
                                // 현재의 상태설정과 비교하여, 차이가 있는 경우 변경을 한다. 수천개의 경우에는 아래의 루프는 심각한 문제가 될 것으로 보인다.
                                for($index = 0; $index < $ordersCnt; $index++) {
                                    if($etomarsRequestNo == $orders[$index]['regno'] ) {
                                        if($errorCode > 0 ) {
                                            $this->orderRepository->updateOrderAccident($orders[$checkedCnt]['id'], 
                                                                       $orders[$checkedCnt]['accident_code'], 
                                                                       $orders[$checkedCnt]['accident_desc'], 
                                                                       $errorCode);
                                        } else {
                                            if($shipneyStatus != $orders[$index]['order_status_id'] ) {
                                                if($orders[$index]['order_status_id'] > SPN_STATE_PICKUP_DELIVERY ) {  // 4 이하는 픽업관련 상태이다. 이경우는 etomars의 상태와는 다르다.
                                                    $orders[$index]['order_status_id'] = $shipneyStatus;
                                                    //Helpers::pre_r($shipneyStatus."<======");
                                                    $result_summary_not_matching_cnt++; 
                                                    $this->updateShippingStatus($orders[$index]['id'], $orders[$index]['regno'], $shipneyStatus);
                                                }
                                            }
                                        }
                                        break;
                                    }
                                }
                            }
                        }
                    }
                } else {
                    $result_summary_error += " ".$response->getStatusCode();
                }
            }
        }

        $result_summary_end = date("Y-m-d H:i:s");

        $result_summary_duration = $result_summary_start." ~ ".$result_summary_start;

        $result_summary = "[".$result_summary_duration."]"."[ST:".$result_summary_order_cnt."][ET:".$result_summary_etomars_cnt."][UPDATE:".$result_summary_not_matching_cnt."][NOTREG:".$result_summary_not_reg_cnt."][ERROR:".$result_summary_error."]\n";
        return $result_summary;
    }

    public function updateShippingStatus($id, $regno, $newStatus) 
    {
        $input['order_status_id'] = $newStatus;

        try {
            if($newStatus == SPN_STATE_WAREHOUSE_USER_CONFIRM ) // 사용자 확인이 필요한 경우
            {
                $newPriceData = $this->updateFromEtomarsPriceData($id, $regno); 
                if(count($newPriceData) > 1) {
                    $input['weight'] = $newPriceData[0];
                    $input['shipping_price_final'] = $newPriceData[1];
                    $input['hint'] = '배송비용 추가('.$newPriceData[0].' , '.newPriceData[1].'원';
                }
            }
            
            $order = $this->orderRepository->update($input, $id);

            if (setting('enable_notifications', false)) {
                // 낮시간에만 보낼수 있도록 해야한다. table하나에 넣고, 그것을 낮시간에 처리하는 방식을 고려해야함.
                if (isset($input['order_status_id'])) {
                    Notification::send([$order->user], new StatusChangedOrder($order, ""));
                }
            }
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }        
    }

    // 픽업이후에 상태 변경을 위한 상태 수집
    public function getOrderInfoList_updateFromEtomarsStatusData() 
    {
        try {
            $request = new Request();

            $arr = array( SPN_STATE_WAREHOUSE_WAIT,
                          SPN_STATE_WAREHOUSE_USER_CONFIRM,
                          SPN_STATE_WAREHOUSE_IN,
                          SPN_STATE_WAREHOUSE_OUT,
                          SPN_STATE_SHIPPING_DEPATURE,
                          SPN_STATE_SHIPPING_ARRIVAL,
                          SPN_STATE_SHIPPING_CUSTOMS,
                          SPN_STATE_SHIPPING_CUSTOMS_CLEAR,
                          SPN_STATE_SHIPPING_DELIVERY_START,
                          SPN_STATE_SHIPPING_DELIVERY/*,SPN_STATE_SHIPPING_DELIVERY_DONE*/,
                          SPN_STATE_RETURN_REQUEST,
                          SPN_STATE_RETURN/*,SPN_STATE_RETURN_DONE*/);

            $status = json_encode(['statuses' => $arr]);

            $request->setJson($status);
            //$this->orderRepository->pushCriteria(new RequestCriteria($request));
            $this->orderRepository->pushCriteria(new OrdersOfStatusesCriteriaArray($arr));
        } catch (RepositoryException $e) {
            Flash::error($e->getMessage());
            return [];
        }

        $orders = $this->orderRepository->all(['id','order_status_id','regno']);
        
        //Helpers::pre_r($status);

        return $orders;
    }

    public function updateFromEtomarsPriceData($id, $regno) 
    {
        $updateInfo = array();

        if( $id > 0 ) {
            $searchOrders = array($regno);

            $client = new HttpClient([
                'defaults' => ['verify' => false],
                'headers' => [ 'Content-Type' => 'application/json' ]
                ]);
    
            $body = ['ApiKey' => $this->etomars_key, 'RegNoList' => $searchOrders];
    
            //Helpers::pre_r(json_encode($body));
    
            $response = $client->post($this->etomars_url_getdata, array('body' => json_encode($body)));
    
            Helpers::pre_r((string) $response->getStatusCode());
            if($response->getStatusCode() == 200) {
                //Helpers::pre_r($this->getOrderInfoList_updateFromEtomarsStatusData());

                $etomarsResult = json_decode($response->getBody(), true);
                //Helpers::pre_r("=============== update price");
                //Helpers::pre_r($etomarsResult);

                if($etomarsResult['Data'] != null) {
                    $etomarsResultCnt = count($etomarsResult['Data']);
                    //Helpers::pre_r($etomarsResult);

                    if( $etomarsResultCnt > 0 ) {
                        array_push($updateInfo, $etomarsResult['Data'][0]['RealWeight']);
                        array_push($updateInfo, $etomarsResult['Data'][0]['ShippingFee']);
                    }
                }
                //$tempArray = objectToArray($etomarsResult);
                //Helpers::pre_r($tempArray[0]['Status']);
            }
        }

        return $updateInfo;
    }
    
    public function regOrderToEtomars($shipneyOrder, $pickupOrderNo) {

        $EtomarsRegNo = "-";

        $body['ApiKey'] = $this->etomars_key;

        $data['NationCode'] = $shipneyOrder['nation_code'];
        $data['ShippingType'] = 'A';
        $data['OrderNo1'] = $shipneyOrder['orderno'];
        $data['OrderNo2'] = $pickupOrderNo;

        $data['SenderName'] = 'Shipney Inc';
        $data['SenderTelno'] = '+827078021094';
        $data['SenderAddr'] = 'C dong #1009 161-8, Magokjungang-ro, Gangseo-gu, Seoul, Korea';

        $data['ReceiverName'] = $shipneyOrder['receiver_name'];
        $data['ReceiverNameExpEng'] = ($shipneyOrder['receiver_eng_name'] != null ? $shipneyOrder['receiver_eng_name'] : '');
        $data['ReceiverTelNo1'] = $shipneyOrder['receiver_phone_digit'].$shipneyOrder['receiver_phone'];
        
        if($shipneyOrder['post_num'] != null && strlen($shipneyOrder['post_num']) > 0) {
            $data['ReceiverZipcode'] = $shipneyOrder['post_num'];
        } else {
            $data['ReceiverZipcode'] = "000000";
        }

        /* 국가에 따라 입력되는 형식이 다름. 
            미국, 중국 : 구역별 내역이 들어가야함.
            나머지 : 첫번째 항목에 검색된 내용이 들어감. 1,2,3,4 합처서 넣어야 함
            */
        switch($data['NationCode']) {
            case "US":
            case "CN":
                {
                    $data['ReceiverState'] = $shipneyOrder['address1'];
                    $data['ReceiverCity'] = $shipneyOrder['address2'];
                    $data['ReceiverDistrict'] = $shipneyOrder['address3'];
                    $data['ReceiverDetailAddr'] = $shipneyOrder['address4'];
                }
                break;
            default:
                {
                    $data['ReceiverState'] = $shipneyOrder['address1'];
                    $data['ReceiverCity'] = $shipneyOrder['address2'];
                    $data['ReceiverDistrict'] = $shipneyOrder['address3'];
                    $data['ReceiverDetailAddr'] = $shipneyOrder['address1'].$shipneyOrder['address2'].$shipneyOrder['address3'].$shipneyOrder['address4'];
                }
                break;
        }

        $data['RealWeight'] = floatval($shipneyOrder['weight']);
        $data['WeightUnit'] = $shipneyOrder['weightunit'];
        $data['BoxCount'] = 1;

        if( $shipneyOrder['size_width'] != null && strlen($shipneyOrder['size_width']) > 0) {
            if( $shipneyOrder['size_length'] != null && strlen($shipneyOrder['size_length']) > 0) {
                if( $shipneyOrder['size_height'] != null && strlen($shipneyOrder['size_height']) > 0) {
                    try 
                    {
                        $data['DimWidth'] = floatval($shipneyOrder['size_width']);
                        $data['DimLength'] = floatval($shipneyOrder['size_length']);
                        $data['DimHeight'] = floatval($shipneyOrder['size_height']);
    
                        $data['DimUnit'] = $shipneyOrder['sizeunit'];
                    } catch(Exception $e) {
                        Helpers::pre_r($responseBody);
                    }
                }
            }
        }

        $data['CurrencyUnit'] = $shipneyOrder['currency'];
        $data['DelvMessage'] = ($shipneyOrder['shipping_msg'] != null ? $shipneyOrder['shipping_msg'] : '');

        $items = $this->getOrderItems($shipneyOrder['orderno']);

        $itemsCnt = count($items);

        $GoodsList = null;

        for($i = 0; $i < $itemsCnt; $i++) {
            $GoodsList[$i]['GoodsName'] = $items[$i]['goodsname'];
            $GoodsList[$i]['Qty'] = $items[$i]['count'];
            $GoodsList[$i]['UnitPrice'] = $items[$i]['price'];
            $GoodsList[$i]['BrandName'] = $items[$i]['name'];
            $GoodsList[$i]['GoodsNameExpEn'] = $items[$i]['goodsname_eng'];
        }

        $data['GoodsList'] = $GoodsList;
        $body['DataList'][0] = $data;

        Helpers::pre_r(json_encode($body));

        $client = new HttpClient([
            'defaults' => ['verify' => false],
            'headers' => [ 'Content-Type' => 'application/json' ]
            ]);

        $response = $client->post($this->etomars_url_regorder, array('body' => json_encode($body)));

        //Helpers::pre_r(json_encode($response->getStatusCode()));

        if($response->getStatusCode() == 200) {
            $etomarsResult = json_decode($response->getBody(), true);
            Helpers::pre_r($this->etomars_url_regorder);
    
            Helpers::pre_r($etomarsResult);
    
            if($etomarsResult != null && $etomarsResult['Data'] != null) {
                Helpers::pre_r($etomarsResult['Data'][0]);
                $EtomarsRegNo = $etomarsResult['Data'][0]['RegNo'];
            }
        }

        return $EtomarsRegNo;
        /*
        regOrder.DimWidth = double.parse(this.size_width);
        regOrder.DimLength = double.parse(this.size_length);
        regOrder.DimHeight = double.parse(this.size_height);
         */
    }

    public function getOrderItems($orderno) {

        try {
            $this->productRepository->pushCriteria(new ProductsOfOrderCriteria($orderno));
        } catch (Exception $e) {
            Helpers::pre_r($e->getMessage());
            Flash::error($e->getMessage());
            return [];
        }

        $items = $this->productRepository->all();
        
        return $items;
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
