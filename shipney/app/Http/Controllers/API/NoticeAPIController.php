<?php
/**
 * File name: NoticeAPIController.php
 * Last modified: 2020.05.04 at 09:04:19
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use App\Repositories\NoticeRepository;
use Flash;
use Illuminate\Http\Request;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class ContractController
 * @package App\Http\Controllers\API
 */

class NoticeAPIController extends Controller
{
    /** @var  NoticeRepository */
    private $noticeRepository;

    public function __construct(NoticeRepository $noticeRepo)
    {
        parent::__construct();
        $this->noticeRepository = $noticeRepo;
    }

    /**
     * .
     * GET|HEAD /notice
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try{
            $this->noticeRepository->pushCriteria(new RequestCriteria($request));
            //$this->noticeRepository->pushCriteria(new LimitOffsetCriteria($request));
            
            //$nation = $request->get("nation") ?? 'KR'; 
            //$lang = $request->get("language") ?? 'KO'; 
            $limit = $request->get("limit") ?? 100; 

            $notice = $this->noticeRepository
                                    ->selectRaw('id, nation, title, writer, disptop, disptop_order, dispHomeMode, active, updated_at')
                                    //->where("active", 1)
                                    //->where('nation', 'like', $nation)
                                    //->where('language', 'like', $lang)
                                    ->orderBy("disptop", "DESC")
                                    //->orderBy("disptop_order", "DESC")
                                    ->orderBy("created_at", "DESC")
                                    ->limit($limit)
                                    ->get();
            //$notice = $this->noticeRepository->select("id, nation, language, ")->orderBy("disptop", "DESC")->orderBy("disptop_order", "DESC")->where("active", 1)->get();
            //$notice = $this->noticeRepository->all();

        } catch (RepositoryException $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse($notice->toArray(), 'notice retrieved successfully');
    }

    /**
     * Display the specified notice.
     * GET|HEAD /notice/{id}
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $id)
    {
        /** @var $notice */
        if (!empty($this->noticeRepository)) {
            try{
                $this->noticeRepository->pushCriteria(new RequestCriteria($request));
                $this->noticeRepository->pushCriteria(new LimitOffsetCriteria($request));
            } catch (RepositoryException $e) {
                return $this->sendError($e->getMessage());
            }
            $notice = $this->noticeRepository->findWithoutFail($id);
        }

        if (empty($notice)) {
            return $this->sendError('notice not found');
        }

        return $this->sendResponse($notice->toArray(), 'notice retrieved successfully');
    }
}
