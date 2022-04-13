<?php

namespace App\Http\Controllers;
use Dompdf\Helpers;

use App\DataTables\NotificationDataTable;
use App\DataTables\NotificationUserDataTable;
use App\DataTables\NotificationOrderDataTable;
use App\Http\Requests\CreateNotificationRequest;
use App\Http\Requests\UpdateNotificationRequest;
use App\Repositories\CustomFieldRepository;
use App\Repositories\NotificationRepository;
use App\Repositories\UserRepository;
use App\Repositories\OrderRepository;
use App\Notifications\StatusChangedOrder;
use App\Notifications\CommonNotification;
use Carbon\Carbon;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Response;
use Prettus\Validator\Exceptions\ValidatorException;

class NotificationController extends Controller
{
    /** @var  NotificationRepository */
    private $notificationRepository;

    /**
     * @var CustomFieldRepository
     */
    private $customFieldRepository;

    private $userRepository;

    private $orderRepository;

    public function __construct(NotificationRepository $notificationRepo, CustomFieldRepository $customFieldRepo,
        UserRepository $userRepo, OrderRepository $orderRepo)
    {
        parent::__construct();
        $this->notificationRepository = $notificationRepo;
        $this->customFieldRepository = $customFieldRepo;
        $this->userRepository = $userRepo;
        $this->orderRepository = $orderRepo;
    }

    /**
     * Display a listing of the Notification.
     *
     * @param NotificationDataTable $notificationDataTable
     * @return Response
     */
    public function index(NotificationDataTable $notificationDataTable)
    {
        return $notificationDataTable->render('notifications.index');
    }

    /**
     * Show the form for creating a new Notification.
     *
     * @return Response
     */
    public function create()
    {
        $user = $this->userRepository->all();
        $order = $this->orderRepository->all();
        $arrys = config('app.notification');

        $hasCustomField = in_array($this->notificationRepository->model(), setting('custom_field_models', []));
        if ($hasCustomField) {
            $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->notificationRepository->model());
            $html = generateCustomField($customFields);
        }
        return view('notifications.create')->with("customFields", isset($html) ? $html : false)
        ->with("user", $user)->with("arrys", $arrys)->with("order", $order);
    }

    /**
     * Show the form for creating a new Notification.
     * 
     * @param NotificationUserDataTable $notificationUserDataTable
     * @param NotificationOrderDataTable $notificationOrderDataTable
     *
     * @return Response
     */
    // public function create(NotificationUserDataTable $notificationUserDataTable, NotificationOrderDataTable $notificationOrderDataTable)
    // {
    //     return view('notifications.create', compact('notificationUserDataTable', 'notificationOrderDataTable'));
    //     // return $notificationUserDataTable->render('notifications.create');
    // }

    /**
     * Show the form for creating a new Notification.
     * 
     * @param NotificationUserDataTable $notificationUserDataTable
     *
     * @return Response
     */
    public function createuser(NotificationUserDataTable $notificationUserDataTable)
    {
        return $notificationUserDataTable->render('notifications.create');
    }

    /**
     * Show the form for creating a new Notification.
     * 
     * @param NotificationOrderDataTable $notificationOrderDataTable
     *
     * @return Response
     */
    public function createorder(NotificationOrderDataTable $notificationOrderDataTable)
    {
        return $notificationOrderDataTable->render('notifications.create');
    }

    /**
     * Show the form for creating a new Notification.
     *
     * @param CreateNotificationRequest $request
     *
     * @return Response
     */
    public function create_search(CreateNotificationRequest $request)
    {
        $user = $this->userRepository->all();
        $order = $this->orderRepository->all();
        
        if($request != null){
            $user = $user -> filter(function ($value, $key) {
                Log::info($value);
                Log::info($key);
            });
        }

        $arrys = config('app.notification');

        $hasCustomField = in_array($this->notificationRepository->model(), setting('custom_field_models', []));
        if ($hasCustomField) {
            $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->notificationRepository->model());
            $html = generateCustomField($customFields);
        }
        // return view('notifications.create')->with("customFields", isset($html) ? $html : false)
        // ->with("user", $user)->with("arrys", $arrys)->with("order", $order);
    }

    /**
     * Store a newly created Notification in storage.
     *
     * @param CreateNotificationRequest $request
     *
     * @return Response
     */
    public function store(CreateNotificationRequest $request)
    {
        if($request->has('users')==null && $request->has('all')==null){
            Flash::error(__('lang.select_user'));
            return redirect(url()->previous());
        }

        $input = $request->all();
        try {

            if (setting('enable_notifications', false)) {
                
                if (isset($input['type'])) {
                    $type = $input['type'];
                    $title = $input['title'];
                    $body = $input['body'];
                    $id = $input['common_id'];
                    $body = strip_tags($body);
                    $image = $input['image'];
                    $users = [];
                    if($request->has('users')){
                        $users = $input['users'];
                    }else if($request->has('all')){
                        $users = $this->userRepository->all();
                        $orders = $this->orderRepository->all();
                        Log::info($id);
                    }
                    foreach ($users as $user) {
                        $user=$this->userRepository->findWithoutFail($user);
                        Notification::send($user, new CommonNotification($user, $type, $title, $body, $image, $id));
                    }
                }
            }
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.saved_successfully', ['operator' => __('lang.notification')]));

        return redirect(route('notifications.index'));
    }

    /**
     * Display the specified Notification.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $notification = $this->notificationRepository->findWithoutFail($id);

        if (empty($notification)) {
            Flash::error('Notification not found');

            return redirect(route('notifications.index'));
        }
        
        return view('notifications.show')->with('notification', $notification);
        // try {
        //     //dd((new Carbon('now'))->format('Y-m-d H:i:s'));
        //     $notification = $this->notificationRepository->update(['read_at' => (new Carbon())], $id);

        // } catch (ValidatorException $e) {
        //     Flash::error($e->getMessage());
        // } catch (\Exception $e) {
        //     Flash::error($e->getMessage());
        // }

        // return redirect(route('notifications.index'));
    }

    /**
     * Show the form for editing the specified Notification.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $notification = $this->notificationRepository->findWithoutFail($id);
        $user = $this->userRepository->all();
        $arrys=config('app.notification');

        if (empty($notification)) {
            Flash::error(__('lang.not_found', ['operator' => __('lang.notification')]));

            return redirect(route('notifications.index'));
        }
        $customFieldsValues = $notification->customFieldsValues()->with('customField')->get();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->notificationRepository->model());
        $hasCustomField = in_array($this->notificationRepository->model(), setting('custom_field_models', []));
        if ($hasCustomField) {
            $html = generateCustomField($customFields, $customFieldsValues);
        }

        return view('notifications.edit')->with('notification', $notification)->with("customFields", isset($html) ? $html : false)->with("user", $user)->with("arrys", $arrys);
    }

    /**
     * Update the specified Notification in storage.
     *
     * @param int $id
     * @param UpdateNotificationRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateNotificationRequest $request)
    {
        $notification = $this->notificationRepository->findWithoutFail($id);
        if (empty($notification)) {
            Flash::error('Notification not found');
            return redirect(route('notifications.index'));
        }
        $input = $request->all();

        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->notificationRepository->model());
        try {
            $notification = $this->notificationRepository->update($input, $id);
            foreach (getCustomFieldsValues($customFields, $request) as $value) {
                $notification->customFieldsValues()
                    ->updateOrCreate(['custom_field_id' => $value['custom_field_id']], $value);
            }
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.updated_successfully', ['operator' => __('lang.notification')]));

        return redirect(route('notifications.index'));
    }

    /**
     * Remove the specified Notification from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $notification = $this->notificationRepository->findWithoutFail($id);

        if (empty($notification)) {
            Flash::error('Notification not found');

            return redirect(route('notifications.index'));
        }

        $this->notificationRepository->delete($id);

        Flash::success(__('lang.deleted_successfully', ['operator' => __('lang.notification')]));

        return redirect(route('notifications.index'));
    }

    /**
     * Remove Media of Notification
     * @param Request $request
     */
    public function removeMedia(Request $request)
    {
        $input = $request->all();
        $notification = $this->notificationRepository->findWithoutFail($input['id']);
        try {
            if ($notification->hasMedia($input['collection'])) {
                $notification->getFirstMedia($input['collection'])->delete();
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
