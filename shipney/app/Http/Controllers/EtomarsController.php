<?php
/**
 * File name: EtomarsController.php
  * Author: zenith
 * Copyright (c) 2020
 *
 */

namespace App\Http\Controllers;

use GuzzleHttp\Client as HttpClient;
use Dompdf\Helpers;

use App\Criteria\Orders\OrdersOfStatusesCriteria;
use App\Criteria\Orders\OrdersOfStatusesCriteriaArray;
use App\Criteria\Orders\OrdersOfUserCriteria;
use App\Criteria\Users\ClientsCriteria;
use App\Criteria\Users\DriversCriteria;
use App\Criteria\Users\DriversOfMarketCriteria;
use App\DataTables\OrderDataTable;
use App\DataTables\ProductOrderDataTable;
use App\Events\OrderChangedEvent;
use App\Http\Requests\CreateOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Notifications\AssignedOrder;
use App\Notifications\StatusChangedOrder;
use App\Repositories\CustomFieldRepository;
use App\Repositories\NotificationRepository;
use App\Repositories\OrderRepository;
use App\Repositories\OrderStatusRepository;
use App\Repositories\PaymentRepository;
use App\Repositories\UserRepository;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Response;
use Prettus\Validator\Exceptions\ValidatorException;

class EtomarsController extends Controller
{
    /** @var  OrderRepository */
    private $orderRepository;

    /**
     * @var CustomFieldRepository
     */
    //private $customFieldRepository;

    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var OrderStatusRepository
     */
    private $orderStatusRepository;
    /** @var  NotificationRepository */
    private $notificationRepository;
    /** @var  PaymentRepository */
    //private $paymentRepository;

    public function __construct(OrderRepository $orderRepo/*, CustomFieldRepository $customFieldRepo, UserRepository $userRepo*/
        , OrderStatusRepository $orderStatusRepo, NotificationRepository $notificationRepo/*, PaymentRepository $paymentRepo*/)
    {
        parent::__construct();
        $this->orderRepository = $orderRepo;
        //$this->customFieldRepository = $customFieldRepo;
        //$this->userRepository = $userRepo;
        $this->orderStatusRepository = $orderStatusRepo;
        $this->notificationRepository = $notificationRepo;
        //$this->paymentRepository = $paymentRepo;
    }

    /**
     * Display a listing of the Order.
     *
     * @param OrderDataTable $orderDataTable
     * @return Response
     */
    public function index(OrderDataTable $orderDataTable)
    {
        return $orderDataTable->render('orders.index');
    }

    /**
     * Show the form for creating a new Order.
     *
     * @return Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created Order in storage.
     *
     * @param CreateOrderRequest $request
     *
     * @return Response
     */
    public function store(CreateOrderRequest $request)
    {
    }

    /**
     * Display the specified Order.
     *
     * @param int $id
     * @param ProductOrderDataTable $productOrderDataTable
     *
     * @return Response
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */

    public function show(ProductOrderDataTable $productOrderDataTable, $id)
    {
    }

    /**
     * Show the form for editing the specified Order.
     *
     * @param int $id
     *
     * @return Response
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function edit($id)
    {
    }

    public function conversionStatusFromEtomars($etomarsStatus) 
    {
        $shipneyStatus = 0;
        
        switch($etomarsStatus) {
            case 10:    // 입고대기
                // Etomars에서는 입고대기 일 수 있으나, 픽업을 요청한 경우, 픽업 상태이므로 이련경우 수정을 하지 않도록.
                $shipneyStatus = 5;                
                break;
            case 15:    // 픽업완료
                $shipneyStatus = 5;
                break;
            case 20:    // 입고완료
                $shipneyStatus = 7;
                break;
            case 30:    // 출고완료
                $shipneyStatus = 8;
                break;
            case 100:   // 항공기 출발
                $shipneyStatus = 9;
                break;
            case 200:   // 항공기 도착
                $shipneyStatus = 10;
                break;
            case 300:   // 통관진행중
                $shipneyStatus = 11;
                break;
            case 400:   // 통관완료
                $shipneyStatus = 12;
                break;
            case 500:   // 배송시작
                $shipneyStatus = 13;
                break;
            case 550:   // 배송중
                $shipneyStatus = 14;
                break;
            case 600:   // 반송완료
                $shipneyStatus = 18;
                break;
            case 700:   // 배송완료
                $shipneyStatus = 15;
                break;
        }
        return $shipneyStatus;
    }

    public function updateFromEtomarsStatusData() 
    {
        $maxSendPoss = 100;
        $ordersCnt = 0;
        $checkedCnt = 0;
        $orders = $this->getOrderInfoList_updateFromEtomarsStatusData();// array('AT2201310697'); //AT2201310697 EUS201525408KR
        $ordersCnt = count($orders);

        $tempIndex = 0;
        $mergeIndex = 0;

        Helpers::pre_r($ordersCnt."<======");

        if( $ordersCnt > 0 ) {
            while($checkedCnt < $ordersCnt) { // 100개까지 보낼수 있다.
                $searchOrders = array();

                for($tempIndex = 0; $tempIndex < $maxSendPoss; $tempIndex++) {
                    $mergeIndex = $tempIndex + $checkedCnt;

                    if($mergeIndex < $ordersCnt) {
                        array_push($searchOrders, $orders[$tempIndex + $checkedCnt]['regno']);
                    } else {
                        $tempIndex++;
                        break;
                    }
                }
                $checkedCnt += $tempIndex;
                Helpers::pre_r($searchOrders);
                
                $client = new HttpClient([
                    'defaults' => ['verify' => false],
                    'headers' => [ 'Content-Type' => 'application/json' ]
                    ]);
        
                $etomars_key = "688c29078a124e37bf19a4b89";
                $etomars_url = "https://system.etomars.com/apiv2/GetShippingStatus";//"https://eparcel.kr/apiv2/GetShippingStatus"; //"https://system.etomars.com/apiv2/GetShippingStatus";
        
                $body = ['ApiKey' => $etomars_key, 'Type' => 'regno', 'RegNoList' => $searchOrders];
        
                //Helpers::pre_r(json_encode($body));
        
                $response = $client->post($etomars_url, array('body' => json_encode($body)));
        
                Helpers::pre_r((string) $response->getStatusCode());
                if($response->getStatusCode() == 200) {
                    //Helpers::pre_r($this->getOrderInfoList_updateFromEtomarsStatusData());
                    //Helpers::pre_r($etomars_url);
    
                    $etomarsResult = json_decode($response->getBody(), true);
                    Helpers::pre_r($etomarsResult);

                    if($etomarsResult['Data'] != null) {
                        $etomarsResultCnt = count($etomarsResult['Data']);
                        //Helpers::pre_r($etomarsResult);
    
                        if( $etomarsResultCnt > 0 ) {
                            $tempOrderId = -1;
                            $tempOrderStatus = -1;
                            $tempOrderRegNo = '';
        
                            $etomarsStatus = -1;
                            $etomarsRequestNo = '';
        
                            for($index = 0; $index < $etomarsResultCnt; $index++) {
                                $etomarsStatus = $etomarsResult['Data'][$index]['Status'];
                                $etomarsRequestNo = $etomarsResult['Data'][$index]['RequestNo'];
        
                                if($etomarsStatus < 0) {
                                    Helpers::pre_r("error! not founc in etomars system");
                                    $shipneyStatus = 19; // error 설정을 한다.
                                } else {
                                    $shipneyStatus = $this->conversionStatusFromEtomars($etomarsStatus) ;
                                }
        
                                // 현재의 상태설정과 비교하여, 차이가 있는 경우 변경을 한다. 수천개의 경우에는 아래의 루프는 심각한 문제가 될 것으로 보인다.
                                for($index = 0; $index < $ordersCnt; $index++) {
                                    if($etomarsRequestNo == $orders[$index]['regno'] ) {
                                        if($shipneyStatus != $orders[$index]['order_status_id'] ) {
                                            if($orders[$index]['order_status_id'] > 3 ) {  // 4 이하는 픽업관련 상태이다. 이경우는 etomars의 상태와는 다르다.
                                                $orders[$index]['order_status_id'] = $shipneyStatus;
                                                Helpers::pre_r($shipneyStatus."<======");
                                                $this->updateShippingInfoData($orders[$index]['id'], $orders[$index]['regno'], $shipneyStatus);
                                            }
                                        }
                                        break;
                                    }
                                }
                                
                                //Helpers::pre_r($etomarsResult['Data'][$index]);
                                //Helpers::pre_r($orders[$index]['order_status_id']);
                            }
                        }
                    }
                    //$tempArray = objectToArray($etomarsResult);
                    //Helpers::pre_r($tempArray[0]['Status']);
                }
            }
        }
    }

    public function updateShippingInfoData($id, $regno, $newStatus) 
    {
        $input['order_status_id'] = $newStatus;
        try {
            if($newStatus == 6 ) // 사용자 확인이 필요한 경우
            {
                $newPriceData = $this->updateFromEtomarsPriceData($id, $regno); 
                if(count($newPriceData) > 1) {
                    $input['weight'] = $newPriceData[0];
                    $input['shipping_price_final'] = $newPriceData[1];
                }
            }
            
            $order = $this->orderRepository->update($input, $id);

            if (setting('enable_notifications', false)) {
                // 낮시간에만 보낼수 있도록 해야한다. table하나에 넣고, 그것을 낮시간에 처리하는 방식을 고려해야함.
                if (isset($input['order_status_id'])) {
                    Notification::send([$order->user], new StatusChangedOrder($order));
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

            $arr = array(5,6,7,8,9,10,11,12,13,14/*,15*/,16,17/*,18*/);

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
    
            $etomars_key = "688c29078a124e37bf19a4b89";
            $etomars_url = "https://system.etomars.com/apiv2/GetData";//"https://eparcel.kr/apiv2/GetData"; //"https://system.etomars.com/apiv2/GetData";
    
            $body = ['ApiKey' => $etomars_key, 'RegNoList' => $searchOrders];
    
            //Helpers::pre_r(json_encode($body));
    
            $response = $client->post($etomars_url, array('body' => json_encode($body)));
    
            Helpers::pre_r((string) $response->getStatusCode());
            if($response->getStatusCode() == 200) {
                //Helpers::pre_r($this->getOrderInfoList_updateFromEtomarsStatusData());
                //Helpers::pre_r($etomars_url);

                $etomarsResult = json_decode($response->getBody(), true);
                Helpers::pre_r("=============== update price");
                Helpers::pre_r($etomarsResult);

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

    /**
     * Update the specified Order in storage.
     *
     * @param int $id
     * @param UpdateOrderRequest $request
     *
     * @return Response
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function update($id, UpdateOrderRequest $request)
    {
    }

    /**
     * Remove the specified Order from storage.
     *
     * @param int $id
     *
     * @return Response
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function destroy($id)
    {
    }

    /**
     * Remove Media of Order
     * @param Request $request
     */
    public function removeMedia(Request $request)
    {
    }
}
