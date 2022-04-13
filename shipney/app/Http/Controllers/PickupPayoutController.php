<?php

namespace App\Http\Controllers;

use App\Criteria\Earnings\EarningOfMarketCriteria;
use App\Criteria\Users\PickupCriteria;
use App\Criteria\Users\FilterByUserCriteria;
use App\DataTables\PickupPayoutDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatePickupPayoutRequest;
use App\Http\Requests\UpdatePickupPayoutRequest;
use App\Repositories\PickupRepository;
use App\Repositories\PickupPayoutRepository;
use App\Repositories\CustomFieldRepository;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Prettus\Validator\Exceptions\ValidatorException;

class PickupPayoutController extends Controller
{
    /** @var  PickupPayoutRepository */
    private $pickupPayoutRepository;

    /**
     * @var CustomFieldRepository
     */
    private $customFieldRepository;

    /**
  * @var UserRepository
  */
private $userRepository;
    /**
     * @var PickupRepository
     */
    private $pickupRepository;

    public function __construct(PickupPayoutRepository $pickupPayoutRepo, PickupRepository $pickupRepository, CustomFieldRepository $customFieldRepo , UserRepository $userRepo)
    {
        parent::__construct();
        $this->pickupPayoutRepository = $pickupPayoutRepo;
        $this->customFieldRepository = $customFieldRepo;
        $this->userRepository = $userRepo;
        $this->pickupRepository = $pickupRepository;
    }

    /**
     * Display a listing of the PickupPayout.
     *
     * @param PickupPayoutDataTable $pickupPayoutDataTable
     * @return Response
     */
    public function index(PickupPayoutDataTable $pickupPayoutDataTable)
    {
        return $pickupPayoutDataTable->render('pickup_payouts.index');
    }

    /**
     * Show the form for creating a new PickupPayout.
     *
     * @return Response
     */
    public function create()
    {
        $this->userRepository->pushCriteria(new PickupCriteria());
        $user = $this->userRepository->pluck('name','id');
        
        $hasCustomField = in_array($this->pickupPayoutRepository->model(),setting('custom_field_models',[]));
            if($hasCustomField){
                $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->pickupPayoutRepository->model());
                $html = generateCustomField($customFields);
            }
        return view('pickup_payouts.create')->with("customFields", isset($html) ? $html : false)->with("user",$user);
    }

    /**
     * Store a newly created PickupPayout in storage.
     *
     * @param CreatePickupPayoutRequest $request
     *
     * @return Response
     * TODO 20210624_hyerin
     */
    public function store(CreatePickupPayoutRequest $request)
    {
        $input = $request->all();
        $input['paid_date'] = Carbon::now();
        $this->pickupRepository->pushCriteria(new FilterByUserCriteria($input['user_id']));
        $pickupEarning = $this->pickupRepository->first();

        if($input['amount'] > $pickupEarning->earning){
            Flash::error('The payout amount must be less than pickup earning');
            return redirect()->back()->withInput($input);
        }
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->pickupPayoutRepository->model());
        try {
            $this->pickupRepository->update(['earning'=>$pickupEarning->earning - $input['amount']], $pickupEarning->id);
            $pickupPayout = $this->pickupPayoutRepository->create($input);
            $pickupPayout->customFieldsValues()->createMany(getCustomFieldsValues($customFields,$request));
            
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.saved_successfully',['operator' => __('lang.drivers_payout')]));

        return redirect(route('pickupPayouts.index'));
    }

    /**
     * Display the specified PickupPayout.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $pickupPayout = $this->pickupPayoutRepository->findWithoutFail($id);

        if (empty($pickupPayout)) {
            Flash::error('Pick up Payout not found');

            return redirect(route('pickupPayouts.index'));
        }

        return view('pickup_payouts.show')->with('pickupPayout', $pickupPayout);
    }

    /**
     * Show the form for editing the specified PickupPayout.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $pickupPayout = $this->pickupPayoutRepository->findWithoutFail($id);
        $user = $this->userRepository->pluck('name','id');
        

        if (empty($pickupPayout)) {
            Flash::error(__('lang.not_found',['operator' => __('lang.drivers_payout')]));

            return redirect(route('pickupPayouts.index'));
        }
        $customFieldsValues = $pickupPayout->customFieldsValues()->with('customField')->get();
        $customFields =  $this->customFieldRepository->findByField('custom_field_model', $this->pickupPayoutRepository->model());
        $hasCustomField = in_array($this->pickupPayoutRepository->model(),setting('custom_field_models',[]));
        if($hasCustomField) {
            $html = generateCustomField($customFields, $customFieldsValues);
        }

        return view('pickup_payouts.edit')->with('pickupPayout', $pickupPayout)->with("customFields", isset($html) ? $html : false)->with("user",$user);
    }

    /**
     * Update the specified PickupPayout in storage.
     *
     * @param  int              $id
     * @param UpdatePickupPayoutRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePickupPayoutRequest $request)
    {
        $pickupPayout = $this->pickupPayoutRepository->findWithoutFail($id);

        if (empty($pickupPayout)) {
            Flash::error('Pick up Payout not found');
            return redirect(route('pickupPayouts.index'));
        }
        $input = $request->all();
        $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->pickupPayoutRepository->model());
        try {
            $pickupPayout = $this->pickupPayoutRepository->update($input, $id);
            
            
            foreach (getCustomFieldsValues($customFields, $request) as $value){
                $pickupPayout->customFieldsValues()
                    ->updateOrCreate(['custom_field_id'=>$value['custom_field_id']],$value);
            }
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.updated_successfully',['operator' => __('lang.drivers_payout')]));

        return redirect(route('pickupPayouts.index'));
    }

    /**
     * Remove the specified PickupPayout from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $pickupPayout = $this->pickupPayoutRepository->findWithoutFail($id);

        if (empty($pickupPayout)) {
            Flash::error('Pick up Payout not found');

            return redirect(route('pickupPayouts.index'));
        }

        $this->pickupPayoutRepository->delete($id);

        Flash::success(__('lang.deleted_successfully',['operator' => __('lang.drivers_payout')]));

        return redirect(route('pickupPayouts.index'));
    }

        /**
     * Remove Media of PickupPayout
     * @param Request $request
     */
    public function removeMedia(Request $request)
    {
        $input = $request->all();
        $pickupPayout = $this->pickupPayoutRepository->findWithoutFail($input['id']);
        try {
            if($pickupPayout->hasMedia($input['collection'])){
                $pickupPayout->getFirstMedia($input['collection'])->delete();
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
