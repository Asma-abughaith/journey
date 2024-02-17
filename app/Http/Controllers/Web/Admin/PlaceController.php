<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\Place\StorePlaceRequest;
use App\Http\Requests\Web\Admin\Place\UpdatePlaceRequest;
use App\Interfaces\Presenters\Web\Admin\CategoryPresenter;
use App\Interfaces\Presenters\Web\Admin\FeaturePresenter;
use App\Interfaces\Presenters\Web\Admin\PlacePresenter;
use App\Interfaces\Presenters\Web\Admin\RegionPresenter;
use App\Interfaces\Presenters\Web\Admin\SubCategoryPresenter;
use App\Interfaces\Presenters\Web\Admin\TagPresenter;
use App\Models\Place;
use App\UseCases\Web\Admin\CategoryUseCase;
use App\UseCases\Web\Admin\FeatureUseCase;
use App\UseCases\Web\Admin\PlaceUseCase;
use App\UseCases\Web\Admin\RegionUseCase;
use App\UseCases\Web\Admin\SubCategoryUseCase;
use App\UseCases\Web\Admin\TagUseCase;
use Brian2694\Toastr\Facades\Toastr;

class PlaceController extends Controller
{
    protected $subCategoryPresenter;
    protected $subCategoryUseCase;
    protected $placePresenter;
    protected $placeUseCase;
    protected $regionPresenter;
    protected $regionUseCase;
    protected $tagUseCase;
    protected $tagPresenter;
    protected $featureUseCase;
    protected $featurePresenter;

    public function __construct(SubCategoryPresenter $subCategoryPresenter, SubCategoryUseCase $subCategoryUseCase, RegionUseCase $regionUseCase, RegionPresenter $regionPresenter, PlaceUseCase $placeUseCase, PlacePresenter $placePresenter, TagUseCase $tagUseCase, TagPresenter $tagPresenter, FeatureUseCase $featureUseCase, FeaturePresenter $featurePresenter)
    {
        $this->placePresenter = $placePresenter;
        $this->placeUseCase = $placeUseCase;
        $this->subCategoryPresenter = $subCategoryPresenter;
        $this->subCategoryUseCase = $subCategoryUseCase;
        $this->regionUseCase = $regionUseCase;
        $this->regionPresenter = $regionPresenter;
        $this->tagUseCase = $tagUseCase;
        $this->tagPresenter = $tagPresenter;
        $this->featureUseCase = $featureUseCase;
        $this->featurePresenter = $featurePresenter;

        //        $this->middleware('checkPermission:view places')->only(['index']);
        //        $this->middleware('checkPermission:create place')->only(['create', 'store']);
        //        $this->middleware('checkPermission:view places')->only(['show']);
        //        $this->middleware('checkPermission:edit place')->only(['edit', 'update']);
        //        $this->middleware('checkPermission:delete place')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $allPlaces = $this->placeUseCase->allPlaces();
            $places = $this->placePresenter->presentAllPlace($allPlaces);
            return view('admin.places.indexv2', compact('places'));
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
        //tags , regions , subcategories
        try {
            $features = $this->featureUseCase->allFeatures();
            $features = $this->featurePresenter->presentAllFeaturesForOtherControllers($features);

            $tags = $this->tagUseCase->allTags();
            $tags = $this->tagPresenter->presentAllTagsForOthersControllers($tags);

            $regions = $this->regionUseCase->allRegions();
            $regions = $this->regionPresenter->presentAllRegionsForOthersControllers($regions);

            $subCategories = $this->subCategoryUseCase->allSubCategories();
            $subCategories = $this->subCategoryPresenter->presentAllSubCategoriesForOtherControllers($subCategories);

            return view('admin.places.create', compact('tags', 'regions', 'subCategories', 'features'));
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlaceRequest $request)
    {
        try {
            $this->placeUseCase->createPlace($request->validated());
            Toastr::success(__('validation.msg.place-created-successfully!'), __('validation.msg.success'));
            return redirect()->route('admin.places.index');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Place $place)
    {
        try {
            $place = $this->placeUseCase->getPlace($place);
            $place = $this->placePresenter->presentPlace($place);
            return view('admin.places.show', compact('place'));
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Place $place)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlaceRequest $request, Place $place)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Place $place)
    {
        try {
            $this->placeUseCase->deletePlace($place);
            Toastr::success('place Deleted successfully!', 'Delete');
            return redirect()->route('admin.places.index');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }
}
