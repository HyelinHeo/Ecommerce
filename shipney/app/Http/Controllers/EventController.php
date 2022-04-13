<?php

namespace App\Http\Controllers;

use App\DataTables\EventDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Repositories\EventRepository;
use App\Repositories\UploadRepository;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Prettus\Validator\Exceptions\ValidatorException;

class EventController extends Controller
{
    /** @var  EventRepository */
    private $eventRepository;

    /**
  * @var UploadRepository
  */
private $uploadRepository;

    public function __construct(EventRepository $eventRepo, UploadRepository $uploadRepo)
    {
        parent::__construct();
        $this->eventRepository = $eventRepo;
        $this->uploadRepository = $uploadRepo;
    }

    /**
     * Display a listing of the Event.
     *
     * @param EventDataTable $eventDataTable
     * @return Response
     */
    public function index(EventDataTable $eventDataTable)
    {
        return $eventDataTable->render('events.index');
    }

    /**
     * Show the form for creating a new Event.
     *
     * @return Response
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created Event in storage.
     *
     * @param CreateEventRequest $request
     *
     * @return Response
     */
    public function store(CreateEventRequest $request)
    {
        $request['end_date']=$request['end_date']." 23:59:59";
        $mode=$request['dispHomeMode_top'].$request['dispHomeMode_mid'].$request['dispHomeMode_bottom'];
        $request['dispHomeMode']=bindec($mode);
        $input = $request->all();
        try {
            $event = $this->eventRepository->create($input);
            if(isset($input['image']) && $input['image']){
                $cacheUpload = $this->uploadRepository->getByUuid($input['image']);
                $mediaItem = $cacheUpload->getMedia('image')->first();
                $mediaItem->copy($event, 'image');
            }
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.saved_successfully',['operator' => __('lang.event')]));

        return redirect(route('events.index'));
    }

    /**
     * Display the specified Event.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $event = $this->eventRepository->findWithoutFail($id);

        if (empty($event)) {
            Flash::error('Event not found');

            return redirect(route('events.index'));
        }

        return view('events.show')->with('event', $event);
    }

    /**
     * Show the form for editing the specified Event.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $event = $this->eventRepository->findWithoutFail($id);
        

        if (empty($event)) {
            Flash::error(__('lang.not_found',['operator' => __('lang.event')]));

            return redirect(route('events.index'));
        }

        return view('events.edit')->with('event', $event);
    }

    /**
     * Update the specified Event in storage.
     *
     * @param  int              $id
     * @param UpdateEventRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEventRequest $request)
    {
        $event = $this->eventRepository->findWithoutFail($id);

        if (empty($event)) {
            Flash::error('Event not found');
            return redirect(route('events.index'));
        }
        $request['end_date']=$request['end_date']." 23:59:59";
        $mode=$request['dispHomeMode_top'].$request['dispHomeMode_mid'].$request['dispHomeMode_bottom'];
        $request['dispHomeMode']=bindec($mode);
        $input = $request->all();

        try {
            $event = $this->eventRepository->update($input, $id);
            
            if(isset($input['image']) && $input['image']){
                $cacheUpload = $this->uploadRepository->getByUuid($input['image']);
                $mediaItem = $cacheUpload->getMedia('image')->first();
                $mediaItem->copy($event, 'image');
            }
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.updated_successfully',['operator' => __('lang.event')]));

        return redirect(route('events.index'));
    }

    /**
     * Remove the specified Event from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $request['active']=false;
        $event = $this->eventRepository->findWithoutFail($id);

        if (empty($event)) {
            Flash::error('Event not found');

            return redirect(route('events.index'));
        }
        try {
            $event = $this->eventRepository->update($request, $id);

        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }


        Flash::success(__('lang.deleted_successfully',['operator' => __('lang.event')]));

        return redirect(route('events.index'));
    }

        /**
     * Remove Media of Event
     * @param Request $request
     */
    public function removeMedia(Request $request)
    {
        $input = $request->all();
        $event = $this->eventRepository->findWithoutFail($input['id']);
        try {
            if($event->hasMedia($input['collection'])){
                $event->getFirstMedia($input['collection'])->delete();
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
