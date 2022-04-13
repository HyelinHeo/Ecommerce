<?php

namespace App\Http\Controllers\API;


use App\Models\FaqCategory;
use App\Repositories\FaqCategoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Response;
use Prettus\Repository\Exceptions\RepositoryException;
use Flash;

/**
 * Class FaqCategoryController
 * @package App\Http\Controllers\API
 */

class FaqCategoryAPIController extends Controller
{
    /** @var  FaqCategoryRepository */
    private $faqCategoryRepository;

    public function __construct(FaqCategoryRepository $faqCategoryRepo)
    {
        $this->faqCategoryRepository = $faqCategoryRepo;
    }

    /**
     * Display a listing of the FaqCategory.
     * GET|HEAD /faqCategories
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try{
            $nation = $request['nation'] ?? 'KR';
            $language = $request['language'] ?? 'KO';
            
            //$this->faqCategoryRepository->pushCriteria(new RequestCriteria($request));
            //$this->faqCategoryRepository->pushCriteria(new LimitOffsetCriteria($request));

            $faqCategories = $this->faqCategoryRepository
                                        ->where('faq_categories.nation', 'like', '%'.$nation.'%')
                                        ->where('faq_categories.language', $language)
                                        ->where('faq_categories.active', 1)
                                        ->orderby('faq_categories.disp_order')
                                        ->join('faqs', 'faq_categories.code', '=', 'faqs.faq_category_code')
                                        ->select('faq_categories.code', 'faq_categories.name', 'faqs.id', 'faqs.question', 'faqs.answer', 'faqs.language')
                                        ->where('faqs.language', $language)
                                        ->where('faqs.active', 1)
                                        ->get();

        } catch (RepositoryException $e) {
            return $this->sendError($e->getMessage());
        }

        //$faqCategories = $this->faqCategoryRepository->all();


        return $this->sendResponse($faqCategories->toArray(), 'Faq Categories retrieved successfully');
    }

    /**
     * Display the specified FaqCategory.
     * GET|HEAD /faqCategories/{id}
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        /** @var FaqCategory $faqCategory */
        if (!empty($this->faqCategoryRepository)) {
            $faqCategory = $this->faqCategoryRepository->findWithoutFail($id);
        }

        if (empty($faqCategory)) {
            return $this->sendError('Faq Category not found');
        }

        return $this->sendResponse($faqCategory->toArray(), 'Faq Category retrieved successfully');
    }
}
