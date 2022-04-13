<?php
/**
 * File name: WebSettingsAPIController.php
 * Last modified: 2020.05.04 at 09:04:19
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\Http\Controllers\API;

use App\Criteria\Markets\ActiveCriteria;
use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Repositories\WebSettingsRepository;
use Flash;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class ContractController
 * @package App\Http\Controllers\API
 */

class WebSettingsAPIController extends Controller
{
    /** @var  WebSettingsRepository */
    private $webSettingsRepository;

    public function __construct(WebSettingsRepository $webSettingsRepo)
    {
        parent::__construct();
        $this->webSettingsRepository = $webSettingsRepo;
    }

    /**
     * .
     * GET|HEAD /web settings
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try{
            $this->webSettingsRepository->pushCriteria(new RequestCriteria($request));
            $webSettings = $this->webSettingsRepository->all();

        } catch (RepositoryException $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse($webSettings->toArray(), 'webSettings retrieved successfully');
    }

    /**
     * Display the specified webSettings.
     * GET|HEAD /websettings/{id}
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $id)
    {
        /** @var $webSettings */
        if (!empty($this->webSettingsRepository)) {
            try{
                $this->webSettingsRepository->pushCriteria(new RequestCriteria($request));
                $this->webSettingsRepository->pushCriteria(new LimitOffsetCriteria($request));
            } catch (RepositoryException $e) {
                return $this->sendError($e->getMessage());
            }
            $webSettings = $this->webSettingsRepository->findWithoutFail($id);
        }

        if (empty($webSettings)) {
            return $this->sendError('webSettings not found');
        }

        return $this->sendResponse($webSettings->toArray(), 'Contract retrieved successfully');
    }
}
