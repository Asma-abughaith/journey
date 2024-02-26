<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\Volunteering\StoreVolunteeringRequest;
use App\Http\Requests\Web\Admin\Volunteering\UpdateVolunteeringRequest;
use App\Interfaces\Presenters\Web\Admin\OrganizerPresenter;
use App\Interfaces\Presenters\Web\Admin\RegionPresenter;
use App\Interfaces\Presenters\Web\Admin\VolunteeringPresenter;
use App\Models\Volunteering;
use App\UseCases\Web\Admin\OrganizerUseCase;
use App\UseCases\Web\Admin\RegionUseCase;
use App\UseCases\Web\Admin\VolunteeringUseCase;
use Brian2694\Toastr\Facades\Toastr;

class VolunteeringController extends Controller
{
    protected $volunteeringUseCase;
    protected $volunteeringPresenter;
    protected $regionPresenter;
    protected $regionUseCase;
    protected $organizerUseCase;
    protected $organizerPresenter;


    public function __construct( RegionUseCase $regionUseCase, RegionPresenter $regionPresenter,VolunteeringUseCase $volunteeringUseCase, VolunteeringPresenter $volunteeringPresenter, OrganizerUseCase $organizerUseCase,OrganizerPresenter $organizerPresenter)
    {

        $this->regionUseCase = $regionUseCase;
        $this->regionPresenter = $regionPresenter;
        $this->volunteeringUseCase =$volunteeringUseCase;
        $this->volunteeringPresenter=$volunteeringPresenter;
        $this->organizerUseCase = $organizerUseCase;
        $this->organizerPresenter = $organizerPresenter;

        //        $this->middleware('checkPermission:view volunteerings')->only(['index']);
        //        $this->middleware('checkPermission:create volunteering')->only(['create', 'store']);
        //        $this->middleware('checkPermission:view volunteerings')->only(['show']);
        //        $this->middleware('checkPermission:edit volunteering')->only(['edit', 'update']);
        //        $this->middleware('checkPermission:delete volunteering')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $allVolunteerings = $this->volunteeringUseCase->allVolunteerings();
            $volunteerings = $this->volunteeringPresenter->presentAllVolunteerings($allVolunteerings);
            return view('admin.volunteerings.index', compact('volunteerings'));
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
            return view('admin.volunteerings.create', compact('organizers', 'regions'));
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVolunteeringRequest $request)
    {
        try {
            $this->volunteeringUseCase->createVolunteering($request->validated());
            Toastr::success(__('validation.msg.volunteering-created-successfully!'), __('validation.msg.success'));
            return redirect()->route('admin.volunteering.index');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Volunteering $volunteering)
    {
        try {
            $volunteering = $this->volunteeringUseCase->getVolunteering($volunteering);
            $volunteering = $this->volunteeringPresenter->presentVolunteering($volunteering);
            return view('admin.volunteerings.show', compact('volunteering'));
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Volunteering $volunteering)
    {
        try {
            $organizers = $this->organizerUseCase->allOrganizers();
            $organizers = $this->organizerPresenter->presentAllOrganizersForAnotherController($organizers);
            $regions = $this->regionUseCase->allRegions();
            $regions = $this->regionPresenter->presentAllRegionsForOthersControllers($regions);

            $volunteering = $this->volunteeringUseCase->getVolunteering($volunteering);
            $volunteering = $this->volunteeringPresenter->presentVolunteering($volunteering);

            return view('admin.volunteerings.edit', compact('volunteering', 'organizers', 'regions'));
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVolunteeringRequest $request, Volunteering $volunteering)
    {
        try {
            $this->volunteeringUseCase->updateVolunteering($volunteering, $request->validated());
            Toastr::success(__('validation.msg.volunteering-updated-successfully!'), __('validation.msg.success'));
            return redirect()->route('admin.volunteering.index');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Volunteering $volunteering)
    {
        try {
            $this->volunteeringUseCase->deleteVolunteering($volunteering);
            Toastr::success('volunteering Deleted successfully!', 'Delete');
            return redirect()->route('admin.volunteering.index');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }
}
