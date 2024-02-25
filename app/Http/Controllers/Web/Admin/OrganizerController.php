<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\Organizer\StoreOrganizerRequest;
use App\Http\Requests\Web\Admin\Organizer\UpdateOrganizerRequest;
use App\Interfaces\Presenters\Web\Admin\OrganizerPresenter;
use App\Models\Organizer;
use App\UseCases\Web\Admin\OrganizerUseCase;
use Brian2694\Toastr\Facades\Toastr;

class OrganizerController extends Controller
{
    protected $organizerPresenter;
    protected $organizerUseCase;

    public function __construct( OrganizerPresenter $organizerPresenter, OrganizerUseCase $organizerUseCase) {
        $this->organizerPresenter = $organizerPresenter;
        $this->organizerUseCase = $organizerUseCase;

//        $this->middleware('checkPermission:view organizers')->only(['index']);
//        $this->middleware('checkPermission:create organizer')->only(['create', 'store']);
//        $this->middleware('checkPermission:view organizers')->only(['show']);
//        $this->middleware('checkPermission:edit organizer')->only(['edit', 'update']);
//        $this->middleware('checkPermission:delete organizer')->only(['destroy']);

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $allOrganizers = $this->organizerUseCase->allOrganizers();
            $organizers = $this->organizerPresenter->presentAllOrganizers($allOrganizers);
            return view('admin.organizers.index',compact('organizers'));
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
        return view('admin.organizers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrganizerRequest $request)
    {
        try {
            $this->organizerUseCase->createOrganizer( $request->validated());
            Toastr::success(__('validation.msg.organizer-created-successfully!'), __('validation.msg.success'));
            return redirect()->route('admin.organizers.index');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Organizer $organizer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Organizer $organizer)
    {
        try {
            $organizer = $this->organizerUseCase->getOrganizer($organizer);
            $organizer = $this->organizerPresenter->persentOrganizer($organizer);
            return view('admin.organizers.edit',compact('organizer'));
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrganizerRequest $request, Organizer $organizer)
    {
        try {
            $this->organizerUseCase->updateOrganizer($organizer, $request->validated());
            Toastr::success(__('validation.msg.organizer-updated-successfully!'), __('validation.msg.success'));
            return redirect()->route('admin.organizers.index');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Organizer $organizer)
    {
        try {
            $this->organizerUseCase->deleteOrganizer($organizer);
            Toastr::success(__('validation.msg.organizer-deleted-successfully!'), __('validation.msg.delete'));
            return redirect()->route('admin.organizers.index');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }
}
