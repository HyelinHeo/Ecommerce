<?php
/**
 * File name: OrderAPIController.php
 * Last modified: 2020.05.31 at 19:34:40
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\Http\Controllers\API;

use Dompdf\Helpers;

use App\Criteria\Orders\OrdersOfStatusesCriteria;
use App\Criteria\Orders\OrdersOfUserCriteria;
use App\Events\OrderChangedEvent; 
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\PaymentAPIController;
use App\Http\Controllers\API\EventUsedAPIController;
use App\Http\Controllers\API\TrackingAPIController;
use App\Models\Order;
use App\Notifications\NewOrder;
use App\Notifications\StatusChangedOrder;
use App\Repositories\OrderRepository;
use App\Repositories\OrderPickupRepository;
use App\Repositories\ProductRepository;
use App\Repositories\UserRepository;
use App\Repositories\OrderAlertRepository;
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
class OrderAPIController extends Controller
{
    /** @var  OrderRepository */
    private $orderRepository;
    /** @var  OrderPickupRepository */
    private $orderPickupRepository;
    /** @var  ProductRepository */
    private $productRepository;
    /** @var  UserRepository */
    private $userRepository;
    private $orderAlertRepository;

    private $homepickAPIController;
    private $paymentAPIController;
    private $eventUsedAPIController;
    private $trackingAPIController;

    private $return_fee = 5000;
    /**
     * OrderAPIController constructor.
     * @param OrderRepository $orderRepo
     * @param ProductRepository $ProductRepository
     * @param UserRepository $userRepository
     */
    public function __construct(OrderRepository $orderRepo, ProductRepository $productRepo, OrderPickupRepository $orderPickupRepo, 
                                UserRepository $userRepo, OrderAlertRepository $orderAlertRepo,
                                HomepickAPIController $homepicCtrl, PaymentAPIController $paymentCtrl,
                                EventUsedAPIController $eventUsedAPICtrl, TrackingAPIController $trackingCtrl)
    {
        $this->orderRepository = $orderRepo;
        $this->orderPickupRepository = $orderPickupRepo;
        $this->productRepository = $productRepo;
        $this->userRepository = $userRepo;
        $this->orderAlertRepository = $orderAlertRepo;
        $this->homepickAPIController = $homepicCtrl;
        $this->paymentAPIController = $paymentCtrl;
        $this->eventUsedAPIController = $eventUsedAPICtrl;
        $this->trackingAPIController = $trackingCtrl;
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
        //;
        //return $this->sendResponse(app_path('Http/Controllers/API/'), 'Orders retrieved successfully');

        try {
            $this->orderRepository->pushCriteria(new RequestCriteria($request));
            $this->orderRepository->pushCriteria(new LimitOffsetCriteria($request));
            $this->orderRepository->pushCriteria(new OrdersOfStatusesCriteria($request));
            $this->orderRepository->pushCriteria(new OrdersOfUserCriteria(auth()->id()));
        } catch (RepositoryException $e) {
            return $this->sendError($e->getMessage());
        }
        $orders = $this->orderRepository->all();

        return $this->sendResponse($orders->toArray(), 'Orders retrieved successfully');
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
        /** @var Order $order */
        if (!empty($this->orderRepository)) {
            try {
                $this->orderRepository->pushCriteria(new RequestCriteria($request));
                $this->orderRepository->pushCriteria(new LimitOffsetCriteria($request));
            } catch (RepositoryException $e) {
                return $this->sendError($e->getMessage());
            }
            $order = $this->orderRepository->findWithoutFail($id);
        }
        
        if (empty($order)) {
            return $this->sendError('Order not found');
        }

        return $this->sendResponse($order->toArray(), 'Order retrieved successfully');
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
        $result = "";
        $retVal = null;
        $inputAll = $request->all();
        $input_order = $inputAll['regorder'];
        $input_items = $inputAll['regitems'];

        // 순서, Shipney server 등록 -> 이투마스 등록 -> 홈픽 등록 (쉽니이외의 등록이 실패하는 경우는 CS 처리를 하도록 한다.)
        // pickup 등록을 바로 하지 않도로 해야 할 것 같아서 아래 픽업등록으로 들어가지 못하도록 변경.
        if($input_order['pickup_request'] == "Y") {
            
            /*
            $retVal = $this->homepickAPIController->regOrderToHomepick($input_order);

            if($retVal['success']) {
                $input_order['order_status_id'] = SPN_STATE_PICKUP_REG_DONE;
                $input_order['pickupOrderNo'] = $retVal['data']['orderNo'];
                $input_order['pickupStatus'] = $retVal['data']['orderStatus'];
                $input_order['boxtype_real'] = $retVal['data']['boxType'];
                $input_order['pickup_add_fee_real'] = $retVal['data']['addFare'];
                $input_order['pickup_base_fee_real'] = $retVal['data']['amount'];
                $input_order['pickup_fee_real'] = $retVal['data']['totalAmount'];
            } else {
                $input_order['pickupOrderNo'] = "";
                $input_order['pickupStatus'] = "";
                $input_order['boxtype_real'] = "";
                $input_order['pickup_add_fee_real'] = "";
                $input_order['pickup_base_fee_real'] = "";
                $input_order['pickup_fee_real'] = "";
            }
            $input_order['pickup_errorCode'] = $retVal['errorCode'];
            $input_order['pickup_errorMessage'] = $retVal['errorMessage'];
            */

            $input_order['order_status_id'] = SPN_STATE_REG_DONE;
            $input_order['pickupOrderNo'] = "";
            $input_order['pickupStatus'] = "";
            $input_order['boxtype_real'] = "";
            $input_order['pickup_add_fee_real'] = "";
            $input_order['pickup_base_fee_real'] = "";
            $input_order['pickup_fee_real'] = "";
            $input_order['pickup_errorCode'] = "";
            $input_order['pickup_errorMessage'] = "";

            // 등록이 되지 않으면, 픽업을 취소 해야 하는 상황이된다. 미리 등록하고, 정상등록시에, 픽업을 하고, 결과를 업데이트 하는 방식으로 해야한다.
            $result = $this->shipneyOderRegist($input_order, $input_items);
        } else {
            $result = $this->shipneyOderRegist($input_order, $input_items);
        }

        // todo : error log save
        
        return $result;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    private function shipneyOderRegist($input_order, $input_items)
    {
        $amount = 0;
        try {
            $user = $this->userRepository->findWithoutFail($input_order['user_id']);
            if (empty($user)) {
                return $this->sendError('User not found');
            }

            $order = $this->orderRepository->create(
                $input_order
                //$request->all()
            );

            $itemCnt = $input_order['item_count'];

            for($i = 0; $i < $itemCnt; $i++) {
                try {
                    $key =  (string)$i;
                    $product = $this->productRepository->create($input_items[$key]);
                } catch (ValidatorException $e) {
                    $this->sendError($e->getMessage());
                }
            }

            // pickup data table에 저장한다.
            $this->shipneyOderPickupRegist($input_order);

            $myEventId = isset($input_order["my_event_id"]) ? $input_order["my_event_id"] : -1;

            if($myEventId > -1) {
               $eventInsert['orderno'] = $input_order['orderno'];
    
               $this->eventUsedAPIController->updateUseEvent($myEventId, $eventInsert);
            }

            // tracking table에 추가한다. updated_at
            $tracking_info["orderno"] = $order["orderno"];
            $tracking_info["updated_at"] = $order["updated_at"];

            $this->trackingAPIController->trackingCreate($tracking_info);
            //Notification::send($order->productOrders[0]->product->market->users, new NewOrder($order));

        } catch (ValidatorException $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse($order->id, 'regist successfully');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    private function shipneyOderPickupRegist($input_order)
    {
        $order_pickup['orderno'] = $input_order['orderno'];
        $order_pickup['pickup_mode'] = $input_order['pickup_mode'];
        $order_pickup['pickup_request'] = $input_order['pickup_request'];
        $order_pickup['pickup_nation_code'] = $input_order['pickup_nation_code'];
        $order_pickup['pickup_post_num'] = $input_order['pickup_post_num'];
        $order_pickup['pickup_address_01'] = $input_order['pickup_address_01'];
        $order_pickup['pickup_address_02'] = $input_order['pickup_address_02'];
        $order_pickup['pickup_reserve'] = $input_order['pickup_reserve'];
        $order_pickup['pickup_type'] = $input_order['pickup_type'];
        $order_pickup['pickup_jeju'] = $input_order['pickup_jeju'];
        $order_pickup['pickup_island'] = $input_order['pickup_island'];
        $order_pickup['boxtype'] = $input_order['boxtype'];
        $order_pickup['pickup_fee'] = $input_order['pickup_fee'];
        $order_pickup['pickup_base_fee'] = $input_order['pickup_base_fee'];
        $order_pickup['pickup_add_fee'] = $input_order['pickup_add_fee'];
        $order_pickup['boxtype_real'] = $input_order['boxtype_real'];
        $order_pickup['pickup_fee_real'] = $input_order['pickup_fee_real'];
        $order_pickup['pickup_base_fee_real'] = $input_order['pickup_base_fee_real'];
        $order_pickup['pickup_add_fee_real'] = $input_order['pickup_add_fee_real'];
        $order_pickup['pickup_currency'] = $input_order['currency'];
        $order_pickup['pickupStatus'] = $input_order['pickupStatus'];
        $order_pickup['pickupOrderNo'] = $input_order['pickupOrderNo'];
        $order_pickup['errorCode'] = $input_order['pickup_errorCode'];
        $order_pickup['errorMessage'] = $input_order['pickup_errorMessage'];

        $amount = 0;
        try {
            $orderPickup = $this->orderPickupRepository->create(
                $order_pickup
            );
        } catch (ValidatorException $e) {
            return -1;
        }

        return $orderPickup->id;
    }

    public function cancel($id, Request $request)
    {
        $order = $this->orderRepository->findWithoutFail($id);
        if (empty($order)) {
            return $this->sendError('Order not found : '.$id);
        }
        
        try {
            $input = $request->all();
    
            $user = $this->userRepository->findWithoutFail($input['user_id']);
            if (empty($user)) {
                return $this->sendError('User not found');
            }

            $alertId = isset($input["alert_id"]) ? $input["alert_id"] : "";
            $userAlert = $order['user_alert'] != null ? $order['user_alert'] : "";

            $cancelData['orderno'] = $order['orderno'];

            if($order['order_status_id'] <= SPN_STATE_PICKUP_REG_DONE) {
                $cancelData['type'] = "all";
            } else if(strlen($alertId) > 0 || $order['order_status_id'] < SPN_STATE_WAREHOUSE_IN) {
                $cancelData['type'] = "partial";

                $total_price = intval($order['payment_amount']);

                if($total_price > $this->return_fee) {
                    $cancel_price = $total_price - $this->return_fee;
                    $remain_price = $this->return_fee;
                    $cancelData['price'] = (string)$cancel_price;
                    $cancelData['remain'] = (string)$remain_price;
                } else {
                    // error
                    return $this->sendError('price error');
                }
            } else {
                return $this->sendError('not allow state error');
            }

            $result = $this->paymentAPIController->cancelPayment($cancelData, "Cancel by user");
                                                  
            if($result != null) {
                $modOrderAlert = null;

                if(strlen($alertId) > 0) {
                    if($userAlert != null && strlen($userAlert) > 0) {
                        $userAlert = str_replace("(".$alertId.")","", $userAlert);
                    }

                    $modOrderAlert['result'] = ALERT_RESULT_CANCEL;
                }

                // check order is cancel all or part
                $newOrder = $this->orderRepository->updateOrderCancel($order['id'], $cancelData['type'], $order['cancel_code'], $order['cancel_desc'], SPN_CANCEL_BY_USER, $userAlert);

                if($newOrder != null) {
                    //return $this->sendResponse($result, __('lang.saved_successfully', ['operator' => __('lang.order')]));
                    $this->trackingAPIController->trackingUpdate($order['orderno'], SPN_STATE_CANCEL, "");
                    //return $this->sendResponse($newOrder, __('lang.saved_successfully', ['operator' => __('lang.order')]));

                    if($modOrderAlert != null) {
                        $this->orderAlertRepository->update($modOrderAlert, $alertId);
                    }
        
                    return $this->sendResponse($newOrder, "canceled", "cancel success");
                }
            }                                                                  
            return $this->sendError('Cancel update error');
                                                                  
            //Notification::send($order->productOrders[0]->product->market->users, new NewOrder($order));

        } catch (ValidatorException $e) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * Update the specified Order in storage.
     *
     * @param int $id
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */

     
    public function updateByUser($id, Request $request)
    {
        $oldOrder = $this->orderRepository->findWithoutFail($id);
        if (empty($oldOrder)) {
            return $this->sendError('Order not found');
        }

        $input = $request->all();

        $modOrder = null;
        $newOrder = null;

        $modPickup = null;
        $modOrderAlert = null;

        $pickupScheduleMod = isset($input["pickup_smod"]) ? $input["pickup_smod"] : 0;

        if($pickupScheduleMod == 1) {
            $modOrder['pickup_reserve'] = $input['pickup_reserve'];
            $modPickup['pickup_reserve'] = $input['pickup_reserve'];
        }

        $pickupAddressMod = isset($input["pickup_amod"]) ? $input["pickup_amod"] : 0;
        if($pickupAddressMod == 1) {
            $modOrder['pickup_post_num'] = $input['pickup_post_num'];
            $modOrder['pickup_address_01'] = $input['pickup_address_01'];
            $modOrder['pickup_address_02'] = $input['pickup_address_02'];
            $modOrder['pickup_type'] = $input['pickup_type'];
            $modOrder['pickup_island'] = $input['pickup_island'];
            $modOrder['pickup_jeju'] = $input['pickup_jeju'];

            $modPickup['pickup_post_num'] = $input['pickup_post_num'];
            $modPickup['pickup_address_01'] = $input['pickup_address_01'];
            $modPickup['pickup_address_02'] = $input['pickup_address_02'];
            $modPickup['pickup_type'] = $input['pickup_type'];
            $modPickup['pickup_island'] = $input['pickup_island'];
            $modPickup['pickup_jeju'] = $input['pickup_jeju'];
        }

        $senderNameMod = isset($input["sender_nmod"]) ? $input["sender_nmod"] : 0;
        if($senderNameMod == 1) {
            $modOrder['sender_name'] = $input['sender_name'];
        }

        $senderPhoneMod = isset($input["sender_pmod"]) ? $input["sender_pmod"] : 0;
        if($senderPhoneMod == 1) {
            $modOrder['sender_phone'] = $input['sender_phone'];
        }

        $senderMsgMod = isset($input["sender_mmod"]) ? $input["sender_mmod"] : 0;
        if($senderMsgMod == 1) {
            $modOrder['shipping_msg'] = $input['shipping_msg'];
        }

        $addrPMod = isset($input["address_pmod"]) ? $input["address_pmod"] : 0;
        if($addrPMod == 1) {
            $modOrder['address_photo1'] = isset($input["address_photo1"]) ? $input["address_photo1"] : '';
            $modOrder['address_photo1_uuid'] = isset($input["address_photo1_uuid"]) ? $input["address_photo1_uuid"] : '';

            $modOrder['address_photo2'] = isset($input["address_photo2"]) ? $input["address_photo2"] : '';
            $modOrder['address_photo2_uuid'] = isset($input["address_photo2_uuid"]) ? $input["address_photo2_uuid"] : '';

            if(strlen($modOrder['address_photo1']) > 0 || strlen($modOrder['address_photo2']) > 0 ) {
                $modOrder['address_trans_done'] = "update";
            } else {
                $modOrder['address_trans_done'] = "";
            }
        }
        
        $addrMod = isset($input["address_mod"]) ? $input["address_mod"] : 0;
        if($addrMod == 1) {
            $modOrder['post_num'] = $input['post_num'];
            $modOrder['address1'] = $input['address1'];
            $modOrder['address2'] = $input['address2'];
            $modOrder['address3'] = $input['address3'];
            $modOrder['address4'] = $input['address4'];
        }
        
        $namePMod = isset($input["name_pmod"]) ? $input["name_pmod"] : 0;
        if($namePMod == 1) {
            $modOrder['receiver_name_photo1'] = isset($input["receiver_name_photo1"]) ? $input["receiver_name_photo1"] : '';
            $modOrder['receiver_name_photo1_uuid'] = isset($input["receiver_name_photo1_uuid"]) ? $input["receiver_name_photo1_uuid"] : '';

            $modOrder['receiver_name_photo2'] = isset($input["receiver_name_photo2"]) ? $input["receiver_name_photo2"] : '';
            $modOrder['receiver_name_photo2_uuid'] = isset($input["receiver_name_photo2_uuid"]) ? $input["receiver_name_photo2_uuid"] : '';

            if(strlen($modOrder['receiver_name_photo1']) > 0 || strlen($modOrder['receiver_name_photo2']) > 0 ) {
                $modOrder['receiver_name_trans_done'] = "update";
            } else {
                $modOrder['receiver_name_trans_done'] = "";
            }
        }

        $nameMod = isset($input["name_mod"]) ? $input["name_mod"] : 0;
        if($nameMod == 1) {
            $modOrder['receiver_name'] = $input['receiver_name'];
            $modOrder['receiver_eng_name'] = $input['receiver_eng_name'];
        }

        $phoneMod = isset($input["phone_mod"]) ? $input["phone_mod"] : 0;
        if($phoneMod == 1) {
            $modOrder['receiver_phone_digit'] = $input['receiver_phone_digit'];
            $modOrder['receiver_phone'] = $input['receiver_phone'];
        }
        
        $alertId = isset($input["alert_id"]) ? $input["alert_id"] : "";
        if(strlen($alertId) > 0 ){
            $userAlert = $oldOrder['user_alert'] != null ? $oldOrder['user_alert'] : "";

            if($userAlert != null && strlen($userAlert) > 0) {
                $userAlert = str_replace("(".$alertId.")","", $userAlert);
                $modOrder['user_alert'] = $userAlert;
            }

            $modOrderAlert['result'] = isset($input["alert_result"]) ? $input["alert_result"] : ALERT_RESULT_ELSE;
        }

        try {
            if($modOrder != null) {
                $newOrder = $this->orderRepository->update($modOrder, $id);

                if($modPickup != null) {
                    $count = $this->orderPickupRepository
                                ->where("orderno", $oldOrder['orderno'])
                                ->update($modPickup);
                }
            }
        } catch (ValidatorException $e) {
            return $this->sendError($e->getMessage());
        }

        try {
            if($modOrder != null) {
                if($modOrderAlert != null) {
                    $this->orderAlertRepository->update($modOrderAlert, $alertId);
                }
            }
        } catch (ValidatorException $e) {
            // do nothing
        }

        return $this->sendResponse($newOrder, "updated", "update success");
    }

    /*
    public function update($id, Request $request)
    {
        $oldOrder = $this->orderRepository->findWithoutFail($id);
        if (empty($oldOrder)) {
            return $this->sendError('Order not found');
        }
        $oldStatus = $oldOrder->payment->status;
        $input = $request->all();

        try {
            $order = $this->orderRepository->update($input, $id);
            if (isset($input['order_status_id']) && $input['order_status_id'] == 5 && !empty($order)) {
                $this->paymentRepository->update(['status' => 'Paid'], $order['payment_id']);
            }
            event(new OrderChangedEvent($oldStatus, $order));

            if (setting('enable_notifications', false)) {
                if (isset($input['order_status_id']) && $input['order_status_id'] != $oldOrder->order_status_id) {
                    Notification::send([$order->user], new StatusChangedOrder($order));
                }
            }

        } catch (ValidatorException $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse($order->toArray(), __('lang.saved_successfully', ['operator' => __('lang.order')]));
    }
    */    
}
