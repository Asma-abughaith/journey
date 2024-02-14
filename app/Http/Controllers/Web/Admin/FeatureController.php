<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\Feature\StoreFeatureRequest;
use App\Http\Requests\Web\Admin\Feature\UpdateFeatureRequest;
use App\Interfaces\Presenters\Web\Admin\FeaturePresenter;
use App\Models\Feature;
use App\UseCases\Web\Admin\FeatureUseCase;
use Brian2694\Toastr\Facades\Toastr;

class FeatureController extends Controller
{
    protected $featurePresenter;
    protected $featureUseCase;
    public function __construct( FeaturePresenter $featurePresenter, FeatureUseCase $featureUseCase) {
        $this->featurePresenter = $featurePresenter;
        $this->featureUseCase = $featureUseCase;

//        $this->middleware('checkPermission:view features')->only(['index']);
//        $this->middleware('checkPermission:create feature')->only(['create', 'store']);
//        $this->middleware('checkPermission:view features')->only(['show']);
//        $this->middleware('checkPermission:edit feature')->only(['edit', 'update']);
//        $this->middleware('checkPermission:delete feature')->only(['destroy']);

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $allFeatures = $this->featureUseCase->allFeatures();
            $features = $this->featurePresenter->presentAllFeatures($allFeatures);
            return view('admin.features.index',compact('features'));
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
        return view('admin.features.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFeatureRequest $request)
    {
        try {
            $this->featureUseCase->createFeature( $request->validated());
            Toastr::success('Feature created successfully!', 'Success');
            return redirect()->route('admin.features.index');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Feature $feature)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Feature $feature)
    {
        try {
            $feature = $this->featureUseCase->getFeature($feature);
            $feature = $this->featurePresenter->persentFeature($feature);
            return view('admin.features.edit',compact('feature'));
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFeatureRequest $request, Feature $feature)
    {
        try {
            $this->featureUseCase->updateFeature($feature, $request->validated());
            Toastr::success('Feature updated successfully!', 'Success');
            return redirect()->route('admin.features.index');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feature $feature)
    {
        try {
            $this->featureUseCase->deleteFeature($feature);
            Toastr::success('The Feature Deleted successfully!', 'Delete');
            return redirect()->route('admin.features.index');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }
}
