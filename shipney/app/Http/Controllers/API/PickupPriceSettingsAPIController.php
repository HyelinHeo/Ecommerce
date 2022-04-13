<?php
/**
 * File name: PickupPriceSettingsAPIController.php
 * Last modified: 2020.05.04 at 09:04:19
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\Http\Controllers\API;

use App\Criteria\Markets\ActiveCriteria;
use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Repositories\PickupPriceSettingsRepository;
use Flash;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class ContractController
 * @package App\Http\Controllers\API
 */

class PickupPriceSettingsAPIController extends Controller
{
    /** @var  PickupPriceSettingsRepository */
    private $pickupPriceSettingsRepository;

    public function __construct(PickupPriceSettingsRepository $pickupPriceSettingsRepo)
    {
        parent::__construct();
        $this->pickupPriceSettingsRepository = $pickupPriceSettingsRepo;
    }

    /**
     * .
     * GET|HEAD /pickupPriceSettings
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try{
            $this->pickupPriceSettingsRepository->pushCriteria(new RequestCriteria($request));
            $pickupPriceSettings = $this->pickupPriceSettingsRepository->all();

        } catch (RepositoryException $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse($pickupPriceSettings->toArray(), 'pickupPriceSettings retrieved successfully');
    }

    /**
     * Display the specified webSettings.
     * GET|HEAD /pickupPriceSettings/{id}
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $id)
    {
        /** @var $webSettings */
        if (!empty($this->pickupPriceSettingsRepository)) {
            try{
                $this->pickupPriceSettingsRepository->pushCriteria(new RequestCriteria($request));
                $this->pickupPriceSettingsRepository->pushCriteria(new LimitOffsetCriteria($request));
            } catch (RepositoryException $e) {
                return $this->sendError($e->getMessage());
            }
            $pickupPriceSettings = $this->pickupPriceSettingsRepository->findWithoutFail($id);
        }

        if (empty($pickupPriceSettings)) {
            return $this->sendError('pickupPriceSettings not found');
        }

        return $this->sendResponse($pickupPriceSettings->toArray(), 'Contract retrieved successfully');
    }
}
