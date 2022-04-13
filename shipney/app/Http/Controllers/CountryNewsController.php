<?php

namespace App\Http\Controllers;

use App\DataTables\CountryNewsDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateCountryNewsRequest;
use App\Http\Requests\UpdateCountryNewsRequest;
use App\Repositories\CountryNewsRepository;
use App\Repositories\CustomFieldRepository;
use App\Repositories\ProductRepository;
use App\Repositories\UserRepository;
use App\Repositories\OptionRepository;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Prettus\Validator\Exceptions\ValidatorException;

class CountryNewsController extends Controller
{
    /** @var  CountryNewsRepository */
    private $countryNewsRepository;

    public function __construct(CountryNewsRepository $countryNewsRepo)
    {
        parent::__construct();
        $this->countryNewsRepository = $countryNewsRepo;
    }

    /**
     * Display a listing of the CountryNews.
     *
     * @param CountryNewsDataTable $countryNewsDataTable
     * @return Response
     */
    public function index(CountryNewsDataTable $countryNewsDataTable)
    {
        return $countryNewsDataTable->render('country_news.index');
    }

    /**
     * Show the form for creating a new CountryNews.
     *
     * @return Response
     */
    public function create()
    {
        /*
        $option = $this->optionRepository->pluck('name', 'id');
        $optionsSelected = [];
        $hasCustomField = in_array($this->countryNewsRepository->model(), setting('custom_field_models', []));
        if ($hasCustomField) {
            $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->countryNewsRepository->model());
            $html = generateCustomField($customFields);
        }
        */
        return view('country_news.create');
//        return view('countryNews.create')->with("customFields", isset($html) ? $html : false)->with("product", $product)->with("user", $user)->with("option", $option)->with("optionsSelected", $optionsSelected);
    }

    /**
     * Store a newly created CountryNews in storage.
     *
     * @param CreateCountryNewsRequest $request
     *
     * @return Response
     */
    public function store(CreateCountryNewsRequest $request)
    {
        $input = $request->all();
        try {
            $countryNews = $this->countryNewsRepository->create($input);

        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.saved_successfully', ['operator' => __('lang.country_news')]));

        return redirect(route('countryNews.index'));
    }

    /**
     * Display the specified CountryNews.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $countryNews = $this->countryNewsRepository->findWithoutFail($id);

        if (empty($countryNews)) {
            Flash::error('CountryNews not found');

            return redirect(route('countryNews.index'));
        }

        return view('country_news.show')->with('countryNews', $countryNews);
    }

    /**
     * Show the form for editing the specified CountryNews.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $countryNews = $this->countryNewsRepository->findWithoutFail($id);

        if (empty($countryNews)) {
            Flash::error(__('lang.not_found', ['operator' => __('lang.countryNews')]));

            return redirect(route('countryNews.index'));
        }

        return view('country_news.edit')->with('countryNews', $countryNews);
    }

    /**
     * Update the specified CountryNews in storage.
     *
     * @param int $id
     * @param UpdateCountryNewsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCountryNewsRequest $request)
    {
        $countryNews = $this->countryNewsRepository->findWithoutFail($id);

        if (empty($countryNews)) {
            Flash::error('CountryNews not found');
            return redirect(route('countryNews.index'));
        }
        $input = $request->all();
        
        try {
            $countryNews = $this->countryNewsRepository->update($input, $id);
            $input['options'] = isset($input['options']) ? $input['options'] : [];

        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.updated_successfully', ['operator' => __('lang.countryNews')]));

        return redirect(route('countryNews.index'));
    }

    /**
     * Remove the specified CountryNews from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $countryNews = $this->countryNewsRepository->findWithoutFail($id);

        if (empty($countryNews)) {
            Flash::error('CountryNews not found');

            return redirect(route('countryNews.index'));
        }

        $this->countryNewsRepository->delete($id);

        Flash::success(__('lang.deleted_successfully', ['operator' => __('lang.countryNews')]));

        return redirect(route('countryNews.index'));
    }

    /**
     * Remove Media of CountryNews
     * @param Request $request
     */
    public function removeMedia(Request $request)
    {
        $input = $request->all();
        $countryNews = $this->countryNewsRepository->findWithoutFail($input['id']);
        try {
            if ($countryNews->hasMedia($input['collection'])) {
                $countryNews->getFirstMedia($input['collection'])->delete();
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
