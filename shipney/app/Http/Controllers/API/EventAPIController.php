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
use App\Models\Event;
use App\Repositories\EventRepository;
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
class EventAPIController extends Controller
{
    /** @var  EventRepository */
    private $eventRepository;

    public function __construct(EventRepository $eventRepo)
    {
        $this->eventRepository = $eventRepo;
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
            $this->eventRepository->pushCriteria(new RequestCriteria($request));
            $this->eventRepository->pushCriteria(new LimitOffsetCriteria($request));
        } catch (RepositoryException $e) {
            return $this->sendError($e->getMessage());
        }
        //$events = $this->eventRepository->all();

        $simple = $request->get("simple") ?? '0'; 

        if($simple == '0') {
            $events = $this->eventRepository
            ->selectRaw('id, type, image_thumb, image, target_nation, discount, discount_type, max_price, limit_use, title, summary, start_date, end_date, dispHomeMode, active, updated_at')
            ->orderBy("created_at", "DESC")
            //->where("active", 1)
            ->get();
            return $this->sendResponse($events->toArray(), 'Events retrieved successfully');
        } else {
            $events = $this->eventRepository
            ->selectRaw('id, type, image_thumb, active, dispHomeMode, updated_at')
            ->orderBy("created_at", "DESC")
            //->where("type", '1')
            ->get();
            return $this->sendResponse($events->toArray(), 'Events retrieved successfully');
        }
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
        if (!empty($this->eventRepository)) {
            $event = $this->eventRepository->findWithoutFail($id);
        }

        if (empty($event)) {
            return $this->sendError('Event not found');
        }

        return $this->sendResponse($event->toArray(), 'Event retrieved successfully');
    }
    
    public function count(Request $request)
    {
        try{
            $this->eventRepository->pushCriteria(new RequestCriteria($request));
            $this->eventRepository->pushCriteria(new LimitOffsetCriteria($request));
        } catch (RepositoryException $e) {
            return $this->sendError($e->getMessage());
        }
        $count = $this->eventRepository
                       ->where("active", 1)
                      ->count();

        //$count = $this->eventRepository->count();

        return $this->sendResponse($count, 'Count retrieved successfully');
    }
}
