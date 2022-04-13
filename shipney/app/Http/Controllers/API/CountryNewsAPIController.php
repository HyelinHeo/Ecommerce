<?php
/**
 * File name: CountryNewsAPIController.php
 * Last modified: 2020.05.04 at 09:04:19
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CountryNews;
use App\Repositories\CountryNewsRepository;
use App\Criteria\CountryNews\CountryNewsSimpleCriteria;
use Flash;
use Illuminate\Http\Request;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class ContractController
 * @package App\Http\Controllers\API
 */

class CountryNewsAPIController extends Controller
{
    /** @var  CountryNewsAPIController */
    private $countryNewsRepository;

    public function __construct(CountryNewsRepository $countryNewsRepo)
    {
        parent::__construct();
        $this->countryNewsRepository = $countryNewsRepo;
    }
    /**
     * .
     * GET|HEAD /CountryNews
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try{
            $this->countryNewsRepository->pushCriteria(new RequestCriteria($request));
            $this->countryNewsRepository->pushCriteria(new LimitOffsetCriteria($request));
            $this->countryNewsRepository->pushCriteria(new CountryNewsSimpleCriteria());
            //$countryNews = $this->countryNewsRepository->select(array('country_news.id', 'country_news.nation'));
            $countryNews = $this->countryNewsRepository->all();

        } catch (RepositoryException $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse($countryNews->toArray(), 'countryNews retrieved successfully');
    }

    /**
     * Display the specified notice.
     * GET|HEAD /countrynews/{id}
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $id)
    {
        /** @var $countryNews */
        if (!empty($this->countryNewsRepository)) {
            try{
                $this->countryNewsRepository->pushCriteria(new RequestCriteria($request));
                $this->countryNewsRepository->pushCriteria(new LimitOffsetCriteria($request));
            } catch (RepositoryException $e) {
                return $this->sendError($e->getMessage());
            }
            $countryNews = $this->countryNewsRepository->findWithoutFail($id);
        }

        if (empty($notice)) {
            return $this->sendError('countryNews not found');
        }

        return $this->sendResponse($countryNews->toArray(), 'countryNews retrieved successfully');
    }

    public function newssummary(Request $request)
    {
        try{
            //$this->countryNewsRepository->pushCriteria(new RequestCriteria($request));
            //$this->countryNewsRepository->pushCriteria(new LimitOffsetCriteria($request));
            //$this->countryNewsRepository->pushCriteria(new CountryNewsSimpleCriteria());
            //$countryNews = $this->countryNewsRepository->select(array('country_news.id', 'country_news.nation'));
            //SELECT a.id, a.nation, a.language, a.title, a.sub_title, a.writer, a.updated_at, COUNT(a.nation) AS cnt FROM (SELECT * FROM country_news order by created_at DESC LIMIT 5000) AS a GROUP BY a.nation ;

            $lang = $request->get("language") ?? 'KO'; 

            $countryNews = $this->countryNewsRepository
                                        //->selectRaw('*, MAX(created_at) as created_at')
                                        ->fromSub(function ($query) use ($lang) {
                                            $query->from('country_news')
                                            ->where('active', 1)
                                            ->where('language', '=', $lang)
                                            ->orderby('created_at','DESC')
                                            ->limit(5000);
                                        }, 'a')
                                        ->selectRaw('a.id, a.nation, a.title, a.sub_title, a.writer, a.updated_at, COUNT(a.nation) AS cnt')
                                        ->groupby('nation')
                                        ->get();

        } catch (RepositoryException $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse($countryNews->toArray(), 'countryNews retrieved successfully');
    }

    public function newslist(Request $request)
    {
        try{
            //$this->countryNewsRepository->pushCriteria(new RequestCriteria($request));
            //$this->countryNewsRepository->pushCriteria(new LimitOffsetCriteria($request));
            //$countryNews = $this->countryNewsRepository->all();

            $nation = $request->get("nation") ?? 'KR'; 
            $lang = $request->get("language") ?? 'KO'; 
            $limit = $request->get("limit") ?? 100; 

            $countryNews = $this->countryNewsRepository
                                        ->selectRaw('id, nation, title, sub_title, writer, updated_at')
                                        ->where('active', 1)
                                        ->where('nation', '=', $nation)
                                        ->where('language', 'like', $lang)
                                        ->orderby('created_at','DESC')
                                        ->limit($limit)
                                        ->get();

        } catch (RepositoryException $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse($countryNews->toArray(), 'countryNews retrieved successfully');
    }
}
