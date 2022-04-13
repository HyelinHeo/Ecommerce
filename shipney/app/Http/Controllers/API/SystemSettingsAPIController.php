<?php
/**
 * File name: SystemSettingsAPIController.php
 * Last modified: 2020.05.04 at 09:04:19
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\Http\Controllers\API;

use App\Criteria\Markets\ActiveCriteria;
use App\Http\Controllers\Controller;
use App\Models\SystemSettings;
use App\Repositories\SystemSettingsRepository;
use Flash;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class ContractController
 * @package App\Http\Controllers\API
 */

class SystemSettingsAPIController extends Controller
{
    /** @var  SystemSettingsRepository */
    private $systemSettingsRepository;

    public function __construct(SystemSettingsRepository $systemSettingsRepo)
    {
        parent::__construct();
        $this->systemSettingsRepository = $systemSettingsRepo;
    }

    /**
     * .
     * GET|HEAD /system settings
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try{
            $this->systemSettingsRepository->pushCriteria(new RequestCriteria($request));
            $systemSettings = $this->systemSettingsRepository->all();

        } catch (RepositoryException $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse($systemSettings->toArray(), 'systemSettings retrieved successfully');
    }

    /**
     * Display the specified systemSettings.
     * GET|HEAD /systemSettings/{id}
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $id)
    {
        /** @var $systemSettings */
        if (!empty($this->systemSettingsRepository)) {
            try{
                $this->systemSettingsRepository->pushCriteria(new RequestCriteria($request));
            } catch (RepositoryException $e) {
                return $this->sendError($e->getMessage());
            }
            $systemSettings = $this->systemSettingsRepository->findWithoutFail($id);
        }

        if (empty($systemSettings)) {
            return $this->sendError('systemSettings not found');
        }

        return $this->sendResponse($systemSettings->toArray(), 'Contract retrieved successfully');
    }
}
