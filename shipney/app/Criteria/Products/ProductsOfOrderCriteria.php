<?php

namespace App\Criteria\Products;

use Illuminate\Http\Request;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class ProductsOfOrderCriteria.
 *
 * @package namespace App\Criteria\Products;
 */
class ProductsOfOrderCriteria implements CriteriaInterface
{
    /**
     * @var value
     */
    private $request;

    /**
     * ProductsOfOrderCriteria constructor.
     * @param array $request
     */
    public function __construct($request)
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
        return $model->where('orderno', $this->request);
    }
}
