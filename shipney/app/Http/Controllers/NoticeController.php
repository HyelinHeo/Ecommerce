<?php

namespace App\Http\Controllers;

use App\DataTables\NoticeDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateNoticeRequest;
use App\Http\Requests\UpdateNoticeRequest;
use App\Repositories\NoticeRepository;
use App\Repositories\CustomFieldRepository;
use App\Repositories\ProductRepository;
use App\Repositories\UserRepository;
use App\Repositories\OptionRepository;
use Flash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Prettus\Validator\Exceptions\ValidatorException;

class NoticeController extends Controller
{
    /** @var  NoticeRepository */
    private $noticeRepository;

    public function __construct(NoticeRepository $noticeRepo)
    {
        parent::__construct();
        $this->noticeRepository = $noticeRepo;
    }

    /**
     * Display a listing of the Notice.
     *
     * @param NoticeDataTable $noticeDataTable
     * @return Response
     */
    public function index(NoticeDataTable $noticeDataTable)
    {
        return $noticeDataTable->render('notice.index');
    }

    /**
     * Show the form for creating a new Notice.
     *
     * @return Response
     */
    public function create()
    {
        /*
        $option = $this->optionRepository->pluck('name', 'id');
        $optionsSelected = [];
        $hasCustomField = in_array($this->noticeRepository->model(), setting('custom_field_models', []));
        if ($hasCustomField) {
            $customFields = $this->customFieldRepository->findByField('custom_field_model', $this->noticeRepository->model());
            $html = generateCustomField($customFields);
        }
        */
        return view('notice.create');
//        return view('notice.create')->with("customFields", isset($html) ? $html : false)->with("product", $product)->with("user", $user)->with("option", $option)->with("optionsSelected", $optionsSelected);
    }

    /**
     * Store a newly created Notice in storage.
     *
     * @param CreateNoticeRequest $request
     *
     * @return Response
     */
    public function store(CreateNoticeRequest $request)
    {
        $mode=$request['dispHomeMode_top'].$request['dispHomeMode_mid'].$request['dispHomeMode_bottom'];
        $request['dispHomeMode']=bindec($mode);
        if($request['dispHomeMode_mid'] == 1){
            DB::table('notice')->where('dispHomeMode', $request['dispHomeMode'])
                                ->update(['dispHomeMode' => 0],
                                        ['updated_at' => \Carbon\Carbon::now()]);
        }
        $input = $request->all();
        try {
            $notice = $this->noticeRepository->create($input);

        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.saved_successfully', ['operator' => __('lang.notice')]));

        return redirect(route('notice.index'));
    }

    /**
     * Display the specified Notice.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $notice = $this->noticeRepository->findWithoutFail($id);

        if (empty($notice)) {
            Flash::error('Notice not found');

            return redirect(route('notice.index'));
        }

        return view('notice.show')->with('notice', $notice);
    }

    /**
     * Show the form for editing the specified Notice.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $notice = $this->noticeRepository->findWithoutFail($id);

        if (empty($notice)) {
            Flash::error(__('lang.not_found', ['operator' => __('lang.notice')]));

            return redirect(route('notice.index'));
        }

        return view('notice.edit')->with('notice', $notice);
    }

    /**
     * Update the specified Notice in storage.
     *
     * @param int $id
     * @param UpdateNoticeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateNoticeRequest $request)
    {
        $notice = $this->noticeRepository->findWithoutFail($id);

        if (empty($notice)) {
            Flash::error('Notice not found');
            return redirect(route('notice.index'));
        }
        $mode=$request['dispHomeMode_top'].$request['dispHomeMode_mid'].$request['dispHomeMode_bottom'];
        $request['dispHomeMode']=bindec($mode);
        if($request['dispHomeMode_mid'] == 1){
            DB::table('notice')->where('dispHomeMode', $request['dispHomeMode'])
                                ->update(['dispHomeMode' => 0],
                                        ['updated_at' => \Carbon\Carbon::now()]);
        }
        $input = $request->all();
        
        try {
            $notice = $this->noticeRepository->update($input, $id);
            $input['options'] = isset($input['options']) ? $input['options'] : [];

        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.updated_successfully', ['operator' => __('lang.notice')]));

        return redirect(route('notice.index'));
    }

    /**
     * Remove the specified Notice from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $request['active']=false;
        $notice = $this->noticeRepository->findWithoutFail($id);

        if (empty($notice)) {
            Flash::error('Notice not found');

            return redirect(route('notice.index'));
        }
        
        try {
            $notice = $this->noticeRepository->update($request, $id);

        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.deleted_successfully', ['operator' => __('lang.notice')]));

        return redirect(route('notice.index'));
    }

    /**
     * Remove Media of Notice
     * @param Request $request
     */
    public function removeMedia(Request $request)
    {
        $input = $request->all();
        $notice = $this->noticeRepository->findWithoutFail($input['id']);
        try {
            if ($notice->hasMedia($input['collection'])) {
                $notice->getFirstMedia($input['collection'])->delete();
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
