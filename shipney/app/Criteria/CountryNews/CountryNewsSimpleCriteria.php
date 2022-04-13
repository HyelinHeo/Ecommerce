<?php
/**
 * File name: NoticeOfSimpleCriteria.php
 * Last modified: 2020.04.30 at 08:21:08
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\Criteria\CountryNews;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class CountryNewsSimpleCriteria.
 *
 * @package namespace App\Criteria\CountryNewsSimpleCriteria;
 */
class CountryNewsSimpleCriteria implements CriteriaInterface
{
    /**
     * CountryNewsSimpleCriteria constructor.
     */
    public function __construct()
    {
    }

    /**
     * Apply criteria in query repository
     *
     * @param string $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        return $model->select(array('country_news.id', 'country_news.nation', 'country_news.language', 'country_news.title', 'country_news.sub_title', 'country_news.writer', 'country_news.active', 'country_news.created_at', 'country_news.updated_at'));
    }
}
