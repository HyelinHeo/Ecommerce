<?php
/**
 * File name: NotificationAPIController.php
 * Last modified: 2020.05.07 at 10:41:01
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Models\EventUsed;
use App\Repositories\EventUsedRepository;
use Carbon\Carbon;
use Flash;
use Illuminate\Http\Request;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class EventAPIController
 * @package App\Http\Controllers\API
 */
class EventUsedAPIController extends Controller
{
    /** @var  eventUsedRepository */
    private $eventUsedRepository;

    public function __construct(EventUsedRepository $eventUsedRepo)
    {
        $this->eventUsedRepository = $eventUsedRepo;
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
            $this->eventUsedRepository->pushCriteria(new RequestCriteria($request));
            $this->eventUsedRepository->pushCriteria(new LimitOffsetCriteria($request));
        } catch (RepositoryException $e) {
            return $this->sendError($e->getMessage());
        }
        $eventUseds = $this->eventUsedRepository->all();

        return $this->sendResponse($eventUseds->toArray(), 'eventUseds retrieved successfully');
    }

    /**
     * Display the specified Event.
     * GET|HEAD /event/{id}
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        /** @var Event $event */
        if (!empty($this->eventUsedRepository)) {
            $eventUsed = $this->eventUsedRepository->findWithoutFail($id);
        }

        if (empty($eventUsed)) {
            return $this->sendError('Event not found');
        }

        return $this->sendResponse($eventUsed->toArray(), 'eventUsed retrieved successfully');
    }
    
    /**
     * Store a newly created Cart in storage.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $input = $request->all();
        try {
            $eventUsed = $this->eventUsedRepository->create($input);
        } catch (ValidatorException $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse($eventUsed->id, 'eventUsed insert successfully');
    }

    public function count(Request $request)
    {
        try{
            $this->eventUsedRepository->pushCriteria(new RequestCriteria($request));
            $this->eventUsedRepository->pushCriteria(new LimitOffsetCriteria($request));
        } catch (RepositoryException $e) {
            return $this->sendError($e->getMessage());
        }
        $count = $this->eventUsedRepository->count();

        return $this->sendResponse($count, 'Count retrieved successfully');
    }

    
    /**
     * Update the specified User in storage.
     *
     * @param int $id
     * @param $input
     *
     */
    public function updateUseEvent($id, $input)
    {
        $eventUsed = $this->eventUsedRepository->findWithoutFail($id);

        if (empty($eventUsed)) {
            return false;
        }

        try {
            $eventUsed = $this->eventUsedRepository->update($input, $id);
        } catch (ValidatorException $e) {
            return $this->sendError($e->getMessage(), 401);
        }

        return $this->sendResponse("success", 'update successfully');
    }
}
