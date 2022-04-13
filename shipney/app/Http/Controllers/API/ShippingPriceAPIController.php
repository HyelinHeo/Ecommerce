<?php
/**
 * File name: SystemSettingsAPIController.php
 * Last modified: 2020.05.04 at 09:04:19
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ShippingPriceNormal;
use App\Models\ShippingPricePremium;
use App\Repositories\ShippingPriceNormalRepository;
use App\Repositories\ShippingPricePremiumRepository;
use Flash;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Exceptions\RepositoryException;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class ShippingPriceAPIController
 * @package App\Http\Controllers\API
 */

class ShippingPriceAPIController extends Controller
{
    /** @var  ShippingPriceNormalRepository */
    private $shippingPriceNormalRepository;
    /** @var  ShippingPricePremiumRepository */
    private $shippingPricePremiumRepository;

    public function __construct(ShippingPriceNormalRepository $shippingPriceNormalRepo, ShippingPricePremiumRepository $shippingPricePremiumRepo)
    {
        parent::__construct();
        $this->shippingPriceNormalRepository = $shippingPriceNormalRepo;
        $this->shippingPricePremiumRepository = $shippingPricePremiumRepo;
    }

    /**
     * .
     * GET|HEAD /price
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try{
            $this->shippingPriceNormalRepository->pushCriteria(new RequestCriteria($request));
            $this->shippingPriceNormalRepository->pushCriteria(new LimitOffsetCriteria($request));
            $this->shippingPricePremiumRepository->pushCriteria(new RequestCriteria($request));
            $this->shippingPricePremiumRepository->pushCriteria(new LimitOffsetCriteria($request));

            $priceNormal = $this->shippingPriceNormalRepository->all();
            $pricePremium = $this->shippingPricePremiumRepository->all();

            if (count($priceNormal) > 0) {
                $result['nation'] = $priceNormal[0]['nation'];
                $result['price_normal_base'] = $priceNormal[0]['price_base'];
                $result['price_normal'] = $priceNormal[0]['price'];

                if (count($pricePremium) > 0) {
                    $result['price_premium_base'] = $pricePremium[0]['price_base'];
                    $result['price_premium'] = $pricePremium[0]['price'];
                }

                $result['currency_unit'] = $priceNormal[0]['KRW'];
                $result['apply_weight'] = $priceNormal[0]['weight'];

                return $this->sendResponse($result, 'priceNormal retrieved successfully');
            } else {
                return $this->sendError("cannot find");
            }     

        } catch (RepositoryException $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse($priceNormal->toArray(), 'priceNormal retrieved successfully');
    }
}
