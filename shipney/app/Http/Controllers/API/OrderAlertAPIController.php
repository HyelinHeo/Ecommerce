<?php
/**
 * File name: OrderAlertAPIController.php
 * Last modified: 2020.05.07 at 10:41:01
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Models\OrderAlert;
use App\Repositories\OrderAlertRepository;
use Carbon\Carbon;
use Flash;
use Illuminate\Http\Request;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class OrderAlertAPIController
 * @package App\Http\Controllers\API
 */
class OrderAlertAPIController extends Controller
{
    /** @var  OrderAlertRepository */
    private $orderAlertRepository;

    public function __construct(OrderAlertRepository $orderAlertRepo)
    {
        $this->orderAlertRepository = $orderAlertRepo;
    }

    /**
     * Display a listing of the Event.
     * GET|HEAD /event
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try{
            $this->orderAlertRepository->pushCriteria(new RequestCriteria($request));
            $this->orderAlertRepository->pushCriteria(new LimitOffsetCriteria($request));
        } catch (RepositoryException $e) {
            return $this->sendError($e->getMessage());
        }
        //$orderalerts = $this->orderAlertRepository->all();

        $orderalerts = $this->orderAlertRepository
        //->selectRaw('id, type, image_thumb, image, start_date, end_date, dispHomeMode, active, updated_at')
        //->orderBy("created_at", "DESC")
        ->where("active", 1)
        ->get();
        return $this->sendResponse($orderalerts->toArray(), 'Events retrieved successfully');
    }

    /**
     * Display the specified Event.
     * GET|HEAD /orderalert/{id}
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        /** @var Event $event */
        if (!empty($this->orderAlertRepository)) {
            $orderalerts = $this->orderAlertRepository->findWithoutFail($id);
        }

        if (empty($orderalerts)) {
            return $this->sendError('orderalert not found');
        }

        return $this->sendResponse($orderalerts->toArray(), 'orderalert retrieved successfully');
    }
    
    public function count(Request $request)
    {
        try{
            $this->orderAlertRepository->pushCriteria(new RequestCriteria($request));
            $this->orderAlertRepository->pushCriteria(new LimitOffsetCriteria($request));
        } catch (RepositoryException $e) {
            return $this->sendError($e->getMessage());
        }
        $count = $this->orderAlertRepository
                       ->where("active", 1)
                      ->count();

        //$count = $this->eventRepository->count();

        return $this->sendResponse($count, 'Count retrieved successfully');
    }
}
