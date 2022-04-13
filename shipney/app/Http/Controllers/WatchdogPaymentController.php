<?php

namespace App\Http\Controllers;

use App\DataTables\WatchdogPaymentDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateWatchdogPaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Repositories\PaymentRepository;
use App\Repositories\CustomFieldRepository;
use App\Repositories\UserRepository;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Prettus\Validator\Exceptions\ValidatorException;

class WatchdogPaymentController extends Controller
{
    /** @var  PaymentRepository */
    private $paymentRepository;

    /**
     * @var CustomFieldRepository
     */
    private $customFieldRepository;

    /**
  * @var UserRepository
  */
private $userRepository;

    public function __construct(PaymentRepository $paymentRepo, CustomFieldRepository $customFieldRepo , UserRepository $userRepo)
    {
        parent::__construct();
        $this->paymentRepository = $paymentRepo;
        $this->customFieldRepository = $customFieldRepo;
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the WatchdogPayment.
     *
     * @param WatchdogPaymentDataTable $watchdogPaymentDataTable
     * @return Response
     */
    public function index(WatchdogPaymentDataTable $watchdogPaymentDataTable)
    {
        return $watchdogPaymentDataTable->render('watchdog.payments.index');
    }

    /**
     * Show the form for creating a new WatchdogPayment.
     *
     * @return Response
     */
    public function create()
    {
        $user = $this->userRepository->pluck('name','id');
        
        $hasCustomField = in_array($this->paymentRepository->model(),setting('custom_field_models',[]));
            if($hasCustomField){
                $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->paymentRepository->model());
                $html = generateCustomField($customFields);
            }
        return view('watchdogPayments.create')->with("customFields", isset($html) ? $html : false)->with("user",$user);
    }

    /**
     * Store a newly created WatchdogPayment in storage.
     *
     * @param CreateWatchdogPaymentRequest $request
     *
     * @return Response
     */
    public function store(CreateWatchdogPaymentRequest $request)
    {
        $input = $request->all();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->paymentRepository->model());
        try {
            $payment = $this->paymentRepository->create($input);
            $payment->customFieldsValues()->createMany(getCustomFieldsValues($customFields,$request));
            
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.saved_successfully',['operator' => __('lang.watchdog_payments')]));

        return redirect(route('watchdogPayments.index'));
    }

    /**
     * Display the specified WatchdogPayment.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $payment = $this->paymentRepository->findWithoutFail($id);

        if (empty($payment)) {
            Flash::error('WatchdogPayment not found');

            return redirect(route('watchdogPayments.index'));
        }

        return view('watchdog.payments.show')->with('payment', $payment);
    }

    /**
     * Show the form for editing the specified WatchdogPayment.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $payment = $this->paymentRepository->findWithoutFail($id);
        $user = $this->userRepository->pluck('name','id');
        

        if (empty($payment)) {
            Flash::error(__('lang.not_found',['operator' => __('lang.payment')]));

            return redirect(route('watchdogPayments.index'));
        }
        
        return view('watchdog.payments.edit')->with('payment', $payment)->with("user",$user);
    }

    /**
     * Update the specified WatchdogPayment in storage.
     *
     * @param  int              $id
     * @param UpdatePaymentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePaymentRequest $request)
    {
        $payment = $this->paymentRepository->findWithoutFail($id);

        if (empty($payment)) {
            Flash::error('WatchdogPayment not found');
            return redirect(route('watchdogPayments.index'));
        }
        Log::info($request);
        $input = $request->all();
        Log::info($input);
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->paymentRepository->model());
        try {
            $payment = $this->paymentRepository->update($input, $id);
            
            
            foreach (getCustomFieldsValues($customFields, $request) as $value){
                $payment->customFieldsValues()
                    ->updateOrCreate(['custom_field_id'=>$value['custom_field_id']],$value);
            }
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.updated_successfully',['operator' => __('lang.watchdog_payments')]));

        return redirect(route('watchdogPayments.index'));
    }

    /**
     * Remove the specified WatchdogPayment from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $payment = $this->paymentRepository->findWithoutFail($id);

        if (empty($payment)) {
            Flash::error('WatchdogPayment not found');

            return redirect(route('watchdogPayments.index'));
        }

        $this->paymentRepository->delete($id);

        Flash::success(__('lang.deleted_successfully',['operator' => __('lang.watchdog_payments')]));

        return redirect(route('watchdogPayments.index'));
    }

        /**
     * Remove Media of WatchdogPayment
     * @param Request $request
     */
    public function removeMedia(Request $request)
    {
        $input = $request->all();
        $payment = $this->paymentRepository->findWithoutFail($input['id']);
        try {
            if($payment->hasMedia($input['collection'])){
                $payment->getFirstMedia($input['collection'])->delete();
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
