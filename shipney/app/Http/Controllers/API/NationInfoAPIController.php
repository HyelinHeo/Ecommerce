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
use App\Models\NationInfo;
use App\Repositories\NationInfoRepository;
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

class NationInfoAPIController extends Controller
{
    /** @var  nationInfoRepository */
    private $nationInfoRepository;

    public function __construct(NationInfoRepository $nationInfoRepo)
    {
        parent::__construct();
        $this->nationInfoRepository = $nationInfoRepo;
    }

    /**
     * .
     * GET|HEAD /nationInfo
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try{
            $this->nationInfoRepository->pushCriteria(new RequestCriteria($request));
            $this->nationInfoRepository->pushCriteria(new LimitOffsetCriteria($request));
            
            $nationInfo = $this->nationInfoRepository->selectRaw('id, nation, image, cover_area, keep_days, delivery_retry, comment, guide, caution, active, updated_at')->get();

        } catch (RepositoryException $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse($nationInfo->toArray(), 'nationInfo retrieved successfully');
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
        if (!empty($this->nationInfoRepository)) {
            try{
                $this->nationInfoRepository->pushCriteria(new RequestCriteria($request));
                $this->nationInfoRepository->pushCriteria(new LimitOffsetCriteria($request));
            } catch (RepositoryException $e) {
                return $this->sendError($e->getMessage());
            }
            $nationInfo = $this->nationInfoRepository->findWithoutFail($id);
        }

        if (empty($nationInfo)) {
            return $this->sendError('nationInfo not found');
        }

        return $this->sendResponse($nationInfo->toArray(), 'nationInfo retrieved successfully');
    }
}
