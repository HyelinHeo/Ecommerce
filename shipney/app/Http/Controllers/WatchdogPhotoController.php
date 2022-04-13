<?php
/**
 * File name: WatchdogPhotoController.php
 * Last modified: 2020.05.05 at 16:55:08
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\Http\Controllers;

use App\Criteria\Orders\OrdersOfUserCriteria;
use App\Criteria\Users\ClientsCriteria;
use App\DataTables\WatchdogPhotoDataTable;
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


class WatchdogPhotoController extends Controller
{
    /** @var  OrderRepository */
    private $orderRepository;

    /**
     * @var UserRepository
     */
    private $userRepository;
    /** @var  NotificationRepository */
    private $notificationRepository;

    public function __construct(OrderRepository $orderRepo, UserRepository $userRepo, NotificationRepository $notificationRepo)
    {
        parent::__construct();
        $this->orderRepository = $orderRepo;
        $this->userRepository = $userRepo;
        $this->notificationRepository = $notificationRepo;
    }

    /**
     * Display a listing of the Order.
     *
     * @param WatchdogPhotoDataTable $watchdogPhotoDataTable
     * @return Response
     */
    public function index(WatchdogPhotoDataTable $watchdogPhotoDataTable)
    {
        return $watchdogPhotoDataTable->render('watchdog.photos.index');
    }

    /**
     * Show the form for creating a new Order.
     *
     * @return Response
     */
    public function create()
    {
        $user = $this->userRepository->getByCriteria(new ClientsCriteria())->pluck('name', 'id');

        $orderStatus = $this->orderStatusRepository->pluck('status', 'id');

        $hasCustomField = in_array($this->orderRepository->model(), setting('custom_field_models', []));
        if ($hasCustomField) {
            $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->orderRepository->model());
            $html = generateCustomField($customFields);
        }
        return view('orders.create')->with("user", $user);
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
        $input = $request->all();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->orderRepository->model());
        try {
            $order = $this->orderRepository->create($input);
            $order->customFieldsValues()->createMany(getCustomFieldsValues($customFields, $request));

        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.saved_successfully', ['operator' => __('lang.watchdog_photos')]));

        return redirect(route('watchdogPhotos.index'));
    }

    /**
     * Display the specified Order.
     *
     * @param int $id
     * @param WatchdogPhotoDataTable $WatchdogPhotoDataTable
     *
     * @return Response
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */

    public function show(WatchdogPhotoDataTable $WatchdogPhotoDataTable, $id)
    {
        $this->orderRepository->pushCriteria(new OrdersOfUserCriteria(auth()->id()));
        $order = $this->orderRepository->findWithoutFail($id);
        if (empty($order)) {
            Flash::error(__('lang.not_found', ['operator' => __('lang.watchdog_photos')]));

            return redirect(route('watchdogPhotos.index'));
        }
    
        return $WatchdogPhotoDataTable->render('watchdog.photos.show', ["order" => $order]);
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
        $this->orderRepository->pushCriteria(new OrdersOfUserCriteria(auth()->id()));
        $order = $this->orderRepository->findWithoutFail($id);
        if (empty($order)) {
            Flash::error(__('lang.not_found', ['operator' => __('lang.watchdog_photos')]));

            return redirect(route('watchdogPhotos.index'));
        }


        $user = $this->userRepository->getByCriteria(new ClientsCriteria())->pluck('name', 'id');
        $user_email = $this->userRepository->getByCriteria(new ClientsCriteria())->pluck('email', 'id');

        return view('watchdog.photos.edit')
        ->with('order', $order)
        ->with("user", $user)
        ->with("user_email", $user_email);
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
        $this->orderRepository->pushCriteria(new OrdersOfUserCriteria(auth()->id()));
        $oldOrder = $this->orderRepository->findWithoutFail($id);
        if (empty($oldOrder)) {
            Flash::error(__('lang.not_found', ['operator' => __('lang.order')]));
            return redirect(route('watchdogPhotos.index'));
        }
        
        $input = $request->all();

        try {

            $order = $this->orderRepository->update($input, $id);

            if (setting('enable_notifications', false)) {
                
            }
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.updated_successfully', ['operator' => __('lang.watchdog_photos')]));

        return redirect(route('watchdogPhotos.index'));
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
        // if (!env('APP_DEMO', false)) {
        //     $this->orderRepository->pushCriteria(new OrdersOfUserCriteria(auth()->id()));
        //     $order = $this->orderRepository->findWithoutFail($id);

        //     if (empty($order)) {
        //         Flash::error(__('lang.not_found', ['operator' => __('lang.order')]));

        //         return redirect(route('orders.index'));
        //     }

        //     $this->orderRepository->delete($id);

        //     Flash::success(__('lang.deleted_successfully', ['operator' => __('lang.order')]));


        // } else {
        //     Flash::warning('This is only demo app you can\'t change this section ');
        // }
        $request['active']=false;
        $oldOrder = $this->orderRepository->findWithoutFail($id);
        if (empty($oldOrder)) {
            Flash::error(__('lang.not_found', ['operator' => __('lang.watchdog_photos')]));
            return redirect(route('watchdogPhotos.index'));
        }
        //$oldStatus = $oldOrder->payment->status;
        
        // Log::info($request);
        try {
            $order = $this->orderRepository->update($request, $id);

        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.deleted_successfully', ['operator' => __('lang.watchdog_photos')]));

        return redirect(route('watchdogPhotos.index'));
    }

    /**
     * Remove Media of Order
     * @param Request $request
     */
    public function removeMedia(Request $request)
    {
        $input = $request->all();
        $order = $this->orderRepository->findWithoutFail($input['id']);
        try {
            if ($order->hasMedia($input['collection'])) {
                $order->getFirstMedia($input['collection'])->delete();
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
