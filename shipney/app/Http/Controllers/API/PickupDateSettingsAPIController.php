<?php
/**
 * File name: PickupDateSettingsAPIController.php
 * Last modified: 2020.05.04 at 09:04:19
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\PickupDateSettingsRepository;
use Flash;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class ContractController
 * @package App\Http\Controllers\API
 */

class PickupDateSettingsAPIController extends Controller
{
    /** @var  PickupDateSettingsRepository */
    private $pickupDateSettingsRepository;

    public function __construct(PickupDateSettingsRepository $pickupDateSettingsRepo)
    {
        parent::__construct();
        $this->pickupDateSettingsRepository = $pickupDateSettingsRepo;
    }

    /**
     * .
     * GET|HEAD /PickupDateSettingsAPIController
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try{
            $this->pickupDateSettingsRepository->pushCriteria(new RequestCriteria($request));
            $pickupDateSettings = $this->pickupDateSettingsRepository->all();

        } catch (RepositoryException $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse($pickupDateSettings->toArray(), 'pickupDateSettings retrieved successfully');
    }

    /**
     * Display the specified pickupDateSettings.
     * GET|HEAD /pickupDateSettings/{id}
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $id)
    {
        /** @var $pickupDateSettings */
        if (!empty($this->pickupDateSettingsRepository)) {
            try{
                $this->pickupDateSettingsRepository->pushCriteria(new RequestCriteria($request));
                $this->pickupDateSettingsRepository->pushCriteria(new LimitOffsetCriteria($request));
            } catch (RepositoryException $e) {
                return $this->sendError($e->getMessage());
            }
            $pickupDateSettings = $this->pickupDateSettingsRepository->findWithoutFail($id);
        }

        if (empty($pickupDateSettings)) {
            return $this->sendError('pickupDateSettings not found');
        }

        return $this->sendResponse($pickupDateSettings->toArray(), 'Contract retrieved successfully');
    }
}
