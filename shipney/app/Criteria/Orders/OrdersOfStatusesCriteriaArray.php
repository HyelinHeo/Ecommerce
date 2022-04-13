<?php

namespace App\Criteria\Orders;

use Illuminate\Http\Request;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class OrdersOfStatusesCriteriaArray.
 *
 * @package namespace App\Criteria\Orders;
 */
class OrdersOfStatusesCriteriaArray implements CriteriaInterface
{
    /**
     * @var array
     */
    private $request;

    /**
     * OrdersOfStatusesCriteria constructor.
     * @param array $request
     */
    public function __construct(array $request)
    {
        $this->request = $request;
    }

    /**
     * Apply criteria in query repository
     *
     * @param string              $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        if (count($this->request) < 1) {
            return $model;
        } else {
            return $model->whereIn('order_status_id', $this->request);
        }
    }
}
