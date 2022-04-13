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
use App\Models\CompanySettings;
use App\Repositories\CompanySettingsRepository;
use Flash;
use Illuminate\Http\Request;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class CompanySettingsAPIController
 * @package App\Http\Controllers\API
 */

class CompanySettingsAPIController extends Controller
{
    /** @var  CompanySettingsRepository */
    private $companySettingsRepository;

    public function __construct(CompanySettingsRepository $companySettingsRepo)
    {
        parent::__construct();
        $this->companySettingsRepository = $companySettingsRepo;
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
            $this->companySettingsRepository->pushCriteria(new RequestCriteria($request));
            $this->companySettingsRepository->pushCriteria(new LimitOffsetCriteria($request));

            $companyInfo = $this->companySettingsRepository->selectRaw("id, type, data1, data2, updated_at")->where("active", 1)->get();
            //$companyInfo = $this->companySettingsRepository->where("active", 1)->get();

        } catch (RepositoryException $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse($companyInfo->toArray(), 'retrieved successfully');
    }
}
