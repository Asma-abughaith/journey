<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\Event\StoreEventRequest;
use App\Http\Requests\Web\Admin\Event\UpdateEventRequest;
use App\Interfaces\Presenters\Web\Admin\EventPresenter;
use App\Interfaces\Presenters\Web\Admin\OrganizerPresenter;
use App\Interfaces\Presenters\Web\Admin\RegionPresenter;
use App\Models\Event;
use App\UseCases\Web\Admin\EventUseCase;
use App\UseCases\Web\Admin\OrganizerUseCase;
use App\UseCases\Web\Admin\RegionUseCase;
use Brian2694\Toastr\Facades\Toastr;

class EventController extends Controller
{

    protected $eventUseCase;
    protected $eventPresenter;
    protected $regionPresenter;
    protected $regionUseCase;
    protected $organizerUseCase;
    protected $organizerPresenter;


    public function __construct( RegionUseCase $regionUseCase, RegionPresenter $regionPresenter,EventUseCase $eventUseCase, EventPresenter $eventPresenter, OrganizerUseCase $organizerUseCase,OrganizerPresenter $organizerPresenter)
    {

        $this->regionUseCase = $regionUseCase;
        $this->regionPresenter = $regionPresenter;
        $this->eventUseCase =$eventUseCase;
        $this->eventPresenter=$eventPresenter;
        $this->organizerUseCase = $organizerUseCase;
        $this->organizerPresenter = $organizerPresenter;

        //        $this->middleware('checkPermission:view events')->only(['index']);
        //        $this->middleware('checkPermission:create event')->only(['create', 'store']);
        //        $this->middleware('checkPermission:view events')->only(['show']);
        //        $this->middleware('checkPermission:edit event')->only(['edit', 'update']);
        //        $this->middleware('checkPermission:delete event')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $allEvents = $this->eventUseCase->allEvents();
            $events = $this->eventPresenter->presentAllEvents($allEvents);
            return view('admin.events.index', compact('events'));
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $organizers = $this->organizerUseCase->allOrganizers();
            $organizers = $this->organizerPresenter->presentAllOrganizersForAnotherController($organizers);
            $regions = $this->regionUseCase->allRegions();
            $regions = $this->regionPresenter->presentAllRegionsForOthersControllers($regions);
            return view('admin.events.create', compact('organizers', 'regions'));
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request)
    {
        try {
            $this->eventUseCase->createEvent($request->validated());
            Toastr::success(__('validation.msg.events-created-successfully!'), __('validation.msg.success'));
            return redirect()->route('admin.events.index');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {

        try {
            $event = $this->eventUseCase->getEvent($event);
            $event = $this->eventPresenter->presentEvent($event);
            return view('admin.events.show', compact('event'));
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        try {
            $organizers = $this->organizerUseCase->allOrganizers();
            $organizers = $this->organizerPresenter->presentAllOrganizersForAnotherController($organizers);
            $regions = $this->regionUseCase->allRegions();
            $regions = $this->regionPresenter->presentAllRegionsForOthersControllers($regions);

            $event = $this->eventUseCase->getEvent($event);
            $event = $this->eventPresenter->presentEvent($event);

            return view('admin.events.edit', compact('event', 'organizers', 'regions'));
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        try {
            $this->eventUseCase->updateEvent($event, $request->validated());
            Toastr::success(__('validation.msg.event-updated-successfully!'), __('validation.msg.success'));
            return redirect()->route('admin.events.index');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        try {
            $this->eventUseCase->deleteEvent($event);
            Toastr::success('event Deleted successfully!', 'Delete');
            return redirect()->route('admin.events.index');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }
}
