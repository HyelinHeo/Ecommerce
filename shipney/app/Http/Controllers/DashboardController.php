<?php

namespace App\Http\Controllers;

use App\Repositories\OrderRepository;
use App\Repositories\PaymentRepository;
use App\Repositories\UserFeedbackRepository;
use App\Repositories\MarketRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{

    /** @var  OrderRepository */
    private $orderRepository;


    /**
     * @var UserRepository
     */
    private $userRepository;

    /** @var  MarketRepository */
    private $marketRepository;
    /** @var  PaymentRepository */
    private $paymentRepository;
    /** @var  UserFeedbackRepository */
    private $userfeedbackRepository;

    public function __construct(OrderRepository $orderRepo, UserRepository $userRepo, PaymentRepository $paymentRepo, MarketRepository $marketRepo, UserFeedbackRepository $userfeedbackRepo)
    {
        parent::__construct();
        $this->orderRepository = $orderRepo;
        $this->userRepository = $userRepo;
        $this->marketRepository = $marketRepo;
        $this->paymentRepository = $paymentRepo;
        $this->userfeedbackRepository = $userfeedbackRepo;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payment_amount = $this->orderRepository->all()->sum('payment_amount');
        $shipping_price = $this->orderRepository->all()->sum('shipping_price');
        $pickup_price = $this->orderRepository->all()->sum('pickup_fee');
        $disount_price = $this->orderRepository->all()->sum('disount_price');
        $shipping_price_base = $this->orderRepository->all()->sum('shipping_price_base');
        $cancel_orders = $this->orderRepository->all()->where('order_status_id','=',18);
        $cancel_orders_count=$cancel_orders->count();
        $watchdog_photos = $this->orderRepository->all()->filter(function ($order) {
            return ($order->photo1_uuid != NULL && !isset($order->photo1))||
            ($order->photo2_uuid != NULL && !isset($order->photo2))||
            ($order->photo3_uuid != NULL && !isset($order->photo3))||
            ($order->address_photo1_uuid != NULL && !isset($order->address_photo1))||
            ($order->address_photo2_uuid != NULL && !isset($order->address_photo2))||
            ($order->receiver_name_photo1_uuid != NULL && !isset($order->receiver_name_photo1))||
            ($order->receiver_name_photo2_uuid != NULL && !isset($order->receiver_name_photo2));
         });
         $watchdog_photos_count=$watchdog_photos->count();
        $cancel_order_price=$cancel_orders->sum('payment_amount');
        $cancel_shipping_price=$cancel_orders->sum('shipping_price');
        $cancel_pickup_price=$cancel_orders->sum('pickup_fee');
        $add_shipping_price_orders=$this->orderRepository->all()->where('shipping_price_final','!=',NULL);
        $add_price_final=$add_shipping_price_orders->sum('shipping_price_final');
        $add_price_shipping=$add_shipping_price_orders->sum('shipping_price');
        $add_price=$add_price_final-$add_price_shipping;
        $cancel_shipping_price_base=$cancel_orders->sum('shipping_price_base');
        $all_price = $payment_amount;
        $business_profit = $payment_amount - $shipping_price_base;
        $ordersCount = $this->orderRepository->count();
        $membersCount = $this->userRepository->count();
        $markets = $this->marketRepository->limit(4)->get();
        $user_feedback = $this->userfeedbackRepository->limit(6)->orderby('id', 'desc')->get();
        $earning = $this->paymentRepository->all()->sum('price');
        $ajaxEarningUrl = route('payments.byMonth',['api_token'=>auth()->user()->api_token]);
        $all_price=getPrice($all_price);
        $shipping_price=getPrice($shipping_price);
        $pickup_price=getPrice($pickup_price);
        $disount_price=getPrice($disount_price);
        $business_profit=getPrice($business_profit);
        $cancel_order_price=getPrice($cancel_order_price);
        $cancel_shipping_price=getPrice($cancel_shipping_price);
        $cancel_pickup_price=getPrice($cancel_pickup_price);
        $add_price=getPrice($add_price);
//        dd($ajaxEarningUrl);
        return view('dashboard.index')
            ->with("ajaxEarningUrl", $ajaxEarningUrl)
            ->with("all_price", $all_price)
            ->with("shipping_price", $shipping_price)
            ->with("pickup_price", $pickup_price)
            ->with("disount_price", $disount_price)
            ->with("business_profit", $business_profit)
            ->with("ordersCount", $ordersCount)
            ->with("watchdog_photos_count", $watchdog_photos_count)
            ->with("cancel_orders_count", $cancel_orders_count)
            ->with("cancel_order_price", $cancel_order_price)
            ->with("cancel_shipping_price", $cancel_shipping_price)
            ->with("cancel_pickup_price", $cancel_pickup_price)
            ->with("add_price", $add_price)
            ->with("markets", $markets)
            ->with("user_feedback", $user_feedback)
            ->with("membersCount", $membersCount)
            ->with("earning", $earning);
    }
}
