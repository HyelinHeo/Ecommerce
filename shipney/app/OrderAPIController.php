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
use App\Models\Order;
use App\Notifications\NewOrder;
use App\Notifications\StatusChangedOrder;
use App\Repositories\OrderRepository;
use App\Repositories\OrderPickupRepository;
use App\Repositories\ProductRepository;
use App\Repositories\UserRepository;
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

    private $homepickAPIController;
    private $paymentAPIController;

    /**
     * OrderAPIController constructor.
     * @param OrderRepository $orderRepo
     * @param ProductRepository $ProductRepository
     * @param UserRepository $userRepository
     */
    public function __construct(OrderRepository $orderRepo, ProductRepository $productRepo, OrderPickupRepository $orderPickupRepo, 
                                UserRepository $userRepo, HomepickAPIController $homepicCtrl/*, PaymentAPIController $paymentCtrl*/)
    {
        $this->orderRepository = $orderRepo;
        $this->orderPickupRepository = $orderPickupRepo;
        $this->productRepository = $productRepo;
        $this->userRepository = $userRepo;
        $this->homepickAPIController = $homepicCtrl;
        //$this->paymentAPIController = $paymentCtrl;
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
        //return $this->sendResponse($request, 'Orders retrieved successfully');

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
        if($input_order['pickup_request'] == "Y") {
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

            //Notification::send($order->productOrders[0]->product->market->users, new NewOrder($order));

        } catch (ValidatorException $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse($order->id, __('lang.saved_successfully', ['operator' => __('lang.order')]));
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
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse($orderPickup->id, __('lang.saved_successfully', ['operator' => __('lang.order')]));
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

            $orderNew = $this->orderRepository->updateOrderCancel($order['id'], 
                                                                  $order['cancel_code'], 
                                                                  $order['cancel_desc'], 
                                                                  SPN_CANCEL_BY_USER);

            if($orderNew != null) {
                $result = $this->paymentAPIController->cancelPayment($orderNew['payment_id'], "Cancel by user");

                //return $this->sendResponse($result, __('lang.saved_successfully', ['operator' => __('lang.order')]));
                return $this->sendResponse($orderNew, __('lang.saved_successfully', ['operator' => __('lang.order')]));
            } else {
                return $this->sendError('Order update error');
            }                                                                  
                                                                  
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

     
    public function update($id, Request $request)
    {
        $oldOrder = $this->orderRepository->findWithoutFail($id);
        if (empty($oldOrder)) {
            return $this->sendError('Order not found');
        }

        $input = $request->all();

        try {
            $order = $this->orderRepository->update($input, $id);

        } catch (ValidatorException $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse(null, __('lang.saved_successfully', ['operator' => __('lang.order')]));
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
