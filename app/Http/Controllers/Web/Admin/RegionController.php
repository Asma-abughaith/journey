<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\Region\StoreRegionRequest;
use App\Http\Requests\Web\Admin\Region\UpdateRegionRequest;
use App\Interfaces\Presenters\Web\Admin\RegionPresenter;
use App\Models\Region;
use App\UseCases\Web\Admin\RegionUseCase;
use Brian2694\Toastr\Facades\Toastr;

class RegionController extends Controller
{
    protected $regionPresenter;
    protected $regionUseCase;

    public function __construct( RegionPresenter $regionPresenter, RegionUseCase $regionUseCase) {
        $this->regionPresenter = $regionPresenter;
        $this->regionUseCase = $regionUseCase;

//        $this->middleware('checkPermission:view regions')->only(['index']);
//        $this->middleware('checkPermission:create region')->only(['create', 'store']);
//        $this->middleware('checkPermission:view regions')->only(['show']);
//        $this->middleware('checkPermission:edit region')->only(['edit', 'update']);
//        $this->middleware('checkPermission:delete region')->only(['destroy']);

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $allRegions = $this->regionUseCase->allRegions();
            $regions = $this->regionPresenter->presentAllRegions($allRegions);
            return view('admin.regions.index',compact('regions'));
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
        return view('admin.regions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRegionRequest $request)
    {
        try {
            $this->regionUseCase->createRegion( $request->validated());
            Toastr::success('Region created successfully!', 'Success');
            return redirect()->route('admin.regions.index');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Region $region)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Region $region)
    {
        try {
            $region = $this->regionUseCase->getRegion($region);
            $region = $this->regionPresenter->persentRegion($region);
            return view('admin.regions.edit',compact('region'));
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRegionRequest $request, Region $region)
    {
        try {
            $this->regionUseCase->updateRegion($region, $request->validated());
            Toastr::success('Region updated successfully!', 'Success');
            return redirect()->route('admin.regions.index');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Region $region)
    {
        try {
            $this->regionUseCase->deleteRegion($region);
            Toastr::success('The Region Deleted successfully!', 'Delete');
            return redirect()->route('admin.regions.index');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }
}
