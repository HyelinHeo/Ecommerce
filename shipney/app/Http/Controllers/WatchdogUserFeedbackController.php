<?php
/**
 * File name: WatchdogUserFeedbackController.php
 * Last modified: 2020.05.05 at 16:55:08
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\Http\Controllers;

use App\Criteria\Users\ClientsCriteria;
use App\DataTables\WatchdogUserFeedbackDataTable;
use App\DataTables\WatchdogUserFeedbackDataTableError;
use App\DataTables\WatchdogUserFeedbackDataTableOpinion;
use App\DataTables\WatchdogUserFeedbackDataTableProposal;
use App\DataTables\WatchdogUserFeedbackDataTableTranslation;
use App\DataTables\WatchdogUserFeedbackDataTableWithdrawal;
use App\DataTables\WatchdogUserFeedbackDataTableDuplicateReport;
use App\DataTables\WatchdogUserFeedbackDataTableOthers;
use App\Http\Requests\CreateUserFeedbackRequest;
use App\Http\Requests\UpdateUserFeedbackRequest;
use App\Repositories\NotificationRepository;
use App\Repositories\UserFeedbackRepository;
use App\Repositories\UserRepository;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Response;
use Prettus\Validator\Exceptions\ValidatorException;



class WatchdogUserFeedbackController extends Controller
{
    /** @var  UserFeedbackRepository */
    private $userFeedbackRepository;

    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var UserFeedbackStatusRepository
     */
    private $orderStatusRepository;
    /** @var  NotificationRepository */
    private $notificationRepository;

    public function __construct(UserFeedbackRepository $userFeedbackRepo, UserRepository $userRepo, NotificationRepository $notificationRepo)
    {
        parent::__construct();
        $this->userFeedbackRepository = $userFeedbackRepo;
        $this->userRepository = $userRepo;
        $this->notificationRepository = $notificationRepo;
    }

    /**
     * Display a listing of the UserFeedback.
     *
     * @param WatchdogUserFeedbackDataTable $watchdogUserFeedbackDataTable
     * @return Response
     */
    public function index(WatchdogUserFeedbackDataTable $watchdogUserFeedbackDataTable)
    {
        return $watchdogUserFeedbackDataTable->render('watchdog.user_feedback.index');
    }

    /**
     * Display a listing of the UserFeedback.
     *
     * @param WatchdogUserFeedbackDataTableError $watchdogUserFeedbackDataTable
     * @return Response
     */
    public function indexError(WatchdogUserFeedbackDataTableError $watchdogUserFeedbackDataTable)
    {
        return $watchdogUserFeedbackDataTable->render('watchdog.user_feedback.index');
    }

    /**
     * Display a listing of the UserFeedback.
     *
     * @param WatchdogUserFeedbackDataTableOpinion $watchdogUserFeedbackDataTable
     * @return Response
     */
    public function indexOpinion(WatchdogUserFeedbackDataTableOpinion $watchdogUserFeedbackDataTable)
    {
        return $watchdogUserFeedbackDataTable->render('watchdog.user_feedback.index');
    }

    /**
     * Display a listing of the UserFeedback.
     *
     * @param WatchdogUserFeedbackDataTableProposal $watchdogUserFeedbackDataTable
     * @return Response
     */
    public function indexProposal(WatchdogUserFeedbackDataTableProposal $watchdogUserFeedbackDataTable)
    {
        return $watchdogUserFeedbackDataTable->render('watchdog.user_feedback.index');
    }

    /**
     * Display a listing of the UserFeedback.
     *
     * @param WatchdogUserFeedbackDataTableTranslation $watchdogUserFeedbackDataTable
     * @return Response
     */
    public function indexTranslation(WatchdogUserFeedbackDataTableTranslation $watchdogUserFeedbackDataTable)
    {
        return $watchdogUserFeedbackDataTable->render('watchdog.user_feedback.index');
    }

    /**
     * Display a listing of the UserFeedback.
     *
     * @param WatchdogUserFeedbackDataTableWithdrawal $watchdogUserFeedbackDataTable
     * @return Response
     */
    public function indexWithdrawal(WatchdogUserFeedbackDataTableWithdrawal $watchdogUserFeedbackDataTable)
    {
        return $watchdogUserFeedbackDataTable->render('watchdog.user_feedback.index');
    }

    /**
     * Display a listing of the UserFeedback.
     *
     * @param WatchdogUserFeedbackDataTableDuplicateReport $watchdogUserFeedbackDataTable
     * @return Response
     */
    public function indexDuplicateReport(WatchdogUserFeedbackDataTableDuplicateReport $watchdogUserFeedbackDataTable)
    {
        return $watchdogUserFeedbackDataTable->render('watchdog.user_feedback.index');
    }

    /**
     * Display a listing of the UserFeedback.
     *
     * @param WatchdogUserFeedbackDataTableOthers $watchdogUserFeedbackDataTable
     * @return Response
     */
    public function indexOthers(WatchdogUserFeedbackDataTableOthers $watchdogUserFeedbackDataTable)
    {
        return $watchdogUserFeedbackDataTable->render('watchdog.user_feedback.index');
    }

    /**
     * Show the form for creating a new UserFeedback.
     *
     * @return Response
     */
    public function create()
    {
        $user = $this->userRepository->getByCriteria(new ClientsCriteria())->pluck('name', 'id');

        return view('watchdogUserFeedback.create')->with("user", $user);
    }

    /**
     * Store a newly created UserFeedback in storage.
     *
     * @param CreateUserFeedbackRequest $request
     *
     * @return Response
     */
    public function store(CreateUserFeedbackRequest $request)
    {
        $input = $request->all();
        try {
            $userFeedback = $this->userFeedbackRepository->create($input);

        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.saved_successfully', ['operator' => __('lang.user_feedback')]));

        return redirect(route('watchdogUserFeedback.index'));
    }

    /**
     * Display the specified UserFeedback.
     *
     * @param int $id
     * @param WatchdogUserFeedbackDataTable $WatchdogUserFeedbackDataTable
     *
     * @return Response
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */

    public function show(WatchdogUserFeedbackDataTable $WatchdogUserFeedbackDataTable, $id)
    {
        $userFeedback = $this->userFeedbackRepository->findWithoutFail($id);
        if (empty($userFeedback)) {
            Flash::error(__('lang.not_found', ['operator' => __('lang.user_feedback')]));

            return redirect(route('watchdogUserFeedback.index'));
        }
    
        return $WatchdogUserFeedbackDataTable->render('watchdog.user_feedback.show', ["userFeedback" => $userFeedback]);
    }

    /**
     * Show the form for editing the specified UserFeedback.
     *
     * @param int $id
     *
     * @return Response
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function edit($id)
    {
        $userFeedback = $this->userFeedbackRepository->findWithoutFail($id);
        if (empty($userFeedback)) {
            Flash::error(__('lang.not_found', ['operator' => __('lang.user_feedback')]));

            return redirect(route('watchdogUserFeedback.index'));
        }


        $user = $this->userRepository->getByCriteria(new ClientsCriteria())->pluck('name', 'id');
        $user_email = $this->userRepository->getByCriteria(new ClientsCriteria())->pluck('email', 'id');

        return view('watchdog.user_feedback.edit')
        ->with("user", $user)
        ->with("user_email", $user_email);
    }

    /**
     * Update the specified UserFeedback in storage.
     *
     * @param int $id
     * @param UpdateUserFeedbackRequest $request
     *
     * @return Response
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function update($id, UpdateUserFeedbackRequest $request)
    {
        $userFeedback = $this->userFeedbackRepository->findWithoutFail($id);
        if (empty($userFeedback)) {
            Flash::error(__('lang.not_found', ['operator' => __('lang.user_feedback')]));
            return redirect(route('watchdogUserFeedback.index'));
        }
        
        $input = $request->all();

        try {
            $userFeedback = $this->userFeedbackRepository->update($input, $id);
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.updated_successfully', ['operator' => __('lang.user_feedback')]));

        return redirect(route('watchdogUserFeedback.index'));
    }

    /**
    * done the specified UserFeedback
    *
    * @param int $id
    *
    * @return Response
    * @throws \Prettus\Repository\Exceptions\RepositoryException
    */
   public function done($id)
   {
       $request['done'] = 1;
       $userFeedback = $this->userFeedbackRepository->findWithoutFail($id);
       if (empty($userFeedback)) {
           Flash::error(__('lang.not_found', ['operator' => __('lang.user_feedback')]));
           return redirect(url()->previous());
       }
       
       try {
           $userFeedback = $this->userFeedbackRepository->update($request, $id);

       } catch (ValidatorException $e) {
           Flash::error($e->getMessage());
       }

       Flash::success(__('lang.done_successfully', ['operator' => __('lang.user_feedback'), 'no' => $id]));

       return redirect(route('watchdogUserFeedback.index'));
   }

     /**
     * Remove the specified UserFeedback from storage.
     *
     * @param int $id
     *
     * @return Response
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function destroy($id)
    {
        // if (!env('APP_DEMO', false)) {
        //     $order = $this->userFeedbackRepository->findWithoutFail($id);

        //     if (empty($order)) {
        //         Flash::error(__('lang.not_found', ['operator' => __('lang.order')]));

        //         return redirect(route('userFeedback.index'));
        //     }

        //     $this->userFeedbackRepository->delete($id);

        //     Flash::success(__('lang.deleted_successfully', ['operator' => __('lang.order')]));


        // } else {
        //     Flash::warning('This is only demo app you can\'t change this section ');
        // }
        $request['active']=false;
        $userFeedback = $this->userFeedbackRepository->findWithoutFail($id);
        if (empty($userFeedback)) {
            Flash::error(__('lang.not_found', ['operator' => __('lang.watchdog_userFeedback')]));
            return redirect(route('watchdogUserFeedback.index'));
        }
        //$oldStatus = $oldUserFeedback->payment->status;
        
        // Log::info($request);
        try {
            $userFeedback = $this->userFeedbackRepository->update($request, $id);

        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.deleted_successfully', ['operator' => __('lang.watchdog_userFeedback')]));

        return redirect(route('watchdogUserFeedback.index'));
    }
}
