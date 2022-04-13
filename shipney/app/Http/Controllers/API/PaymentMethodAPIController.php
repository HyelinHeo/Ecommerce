<?php

namespace App\Http\Controllers\API;


use App\Models\PaymentMethod;
use App\Repositories\PaymentMethodRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Response;
use Prettus\Repository\Exceptions\RepositoryException;
use Flash;

/**
 * Class PaymentMethodAPIController
 * @package App\Http\Controllers\API
 */
class PaymentMethodAPIController extends Controller
{
    /** @var  PaymentMethodRepository */
    private $paymentMethodRepository;

    public function __construct(PaymentMethodRepository $paymentMethodRepo)
    {
        $this->paymentMethodRepository = $paymentMethodRepo;
    }

    /**
     * Display a listing of the Payment.
     * GET|HEAD /paymentmethods
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $this->paymentMethodRepository->pushCriteria(new RequestCriteria($request));
            $this->paymentMethodRepository->pushCriteria(new LimitOffsetCriteria($request));
        } catch (RepositoryException $e) {
            return $this->sendError($e->getMessage());
        }
        $paymentMethods = $this->paymentMethodRepository->all();

        return $this->sendResponse($paymentMethods->toArray(), 'paymentMethods retrieved successfully');
    }

    /**
     * Display the specified paymentMethods.
     * GET|HEAD /paymentmethods/{id}
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        if (!empty($this->paymentMethodRepository)) {
            $paymentMethods = $this->paymentMethodRepository->findWithoutFail($id);
        }

        if (empty($paymentMethods)) {
            return $this->sendError('paymentMethods not found');
        }

        return $this->sendResponse($paymentMethods->toArray(), 'paymentMethods retrieved successfully');
    }
}
