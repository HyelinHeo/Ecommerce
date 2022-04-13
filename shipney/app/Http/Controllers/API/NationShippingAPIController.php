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
use App\Models\NationShipping;
use App\Repositories\NationShippingRepository;
use Flash;
use Illuminate\Http\Request;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class NationShippingAPIController
 * @package App\Http\Controllers\API
 */

class NationShippingAPIController extends Controller
{
    /** @var  nationShippingRepository */
    private $nationShippingRepository;

    public function __construct(NationShippingRepository $nationShippingRepo)
    {
        parent::__construct();
        $this->nationShippingRepository = $nationShippingRepo;
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
            $this->nationShippingRepository->pushCriteria(new RequestCriteria($request));
            $this->nationShippingRepository->pushCriteria(new LimitOffsetCriteria($request));
            
            $nationShipping = $this->nationShippingRepository->where("active", 1)->get();

        } catch (RepositoryException $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse($nationShipping->toArray(), 'nationShipping retrieved successfully');
    }

    /**
     * Display the specified notice.
     * GET|HEAD /nationShipping/{id}
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $id)
    {
        /** @var $nationShipping */
        if (!empty($this->nationShippingRepository)) {
            try{
                $this->nationShippingRepository->pushCriteria(new RequestCriteria($request));
                $this->nationShippingRepository->pushCriteria(new LimitOffsetCriteria($request));
            } catch (RepositoryException $e) {
                return $this->sendError($e->getMessage());
            }
            $nationShipping = $this->nationShippingRepository->findWithoutFail($id);
        }

        if (empty($nationShipping)) {
            return $this->sendError('nationShipping not found');
        }

        return $this->sendResponse($nationShipping->toArray(), 'nationShipping retrieved successfully');
    }
}
