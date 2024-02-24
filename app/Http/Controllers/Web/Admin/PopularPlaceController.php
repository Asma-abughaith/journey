<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\PopularPlace\StorePopularPlaceRequest;
use App\Http\Requests\Web\Admin\PopularPlace\UpdatePopularPlaceRequest;
use App\Interfaces\Presenters\Web\Admin\PlacePresenter;
use App\Interfaces\Presenters\Web\Admin\PopularPlacePresenter;
use App\Interfaces\Presenters\Web\Admin\TopTenPlacePresenter;
use App\Models\PopularPlace;
use App\UseCases\Web\Admin\PlaceUseCase;
use App\UseCases\Web\Admin\PopularPlaceUseCase;
use App\UseCases\Web\Admin\TopTenPlaceUseCase;
use Brian2694\Toastr\Facades\Toastr;

class PopularPlaceController extends Controller
{
    protected $popularPlacesPresenter;
    protected $popularPlacesUseCase;
    protected $placeUseCase;
    protected $placePresenter;

    public function __construct( PopularPlacePresenter $popularPlacesPresenter, PopularPlaceUseCase $popularPlacesUseCase, PlaceUseCase $placeUseCase, PlacePresenter $placePresenter) {
        $this->popularPlacesPresenter = $popularPlacesPresenter;
        $this->popularPlacesUseCase = $popularPlacesUseCase;
        $this->placePresenter = $placePresenter;
        $this->placeUseCase = $placeUseCase;

//        $this->middleware('checkPermission:view popularPlaces')->only(['index']);
//        $this->middleware('checkPermission:create popularPlace')->only(['create', 'store']);
//        $this->middleware('checkPermission:view popularPlaces')->only(['show']);
//        $this->middleware('checkPermission:edit popularPlace')->only(['edit', 'update']);
//        $this->middleware('checkPermission:delete popularPlace')->only(['destroy']);

    }
    //popularPlaces
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $allPopularPlaces = $this->popularPlacesUseCase->allPopularPlaces();
            $popularPlaces = $this->popularPlacesPresenter->presentAllPopularPlaces($allPopularPlaces);
            return view('admin.popular_places.index',compact('popularPlaces'));
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
            $allPlaces = $this->placeUseCase->allPlaces();
            $places = $this->placePresenter->presentAllPlacesForAnoterController($allPlaces);
            return view('admin.popular_places.create', compact('places'));
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePopularPlaceRequest $request)
    {
        try {
            $this->popularPlacesUseCase->createPopularPlace($request->validated());
            Toastr::success('Popular Place created successfully!', 'Success');
            return redirect()->route('admin.popularPlaces.index');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withErrors($request->errors)->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PopularPlace $popularPlace)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PopularPlace $popularPlace)
    {
        try {
            $allPlaces = $this->placeUseCase->allPlaces();
            $places = $this->placePresenter->presentAllPlacesForAnoterController($allPlaces);


            $popular = $this->popularPlacesUseCase->getPopularPlace($popularPlace);
            $popular = $this->popularPlacesPresenter->presentPopularPlace($popular);

            return view('admin.popular_places.edit',compact('popular','places'));
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePopularPlaceRequest $request, PopularPlace $popularPlace)
    {
        try {
            $this->popularPlacesUseCase->updatePopularPlace($popularPlace, $request->validated());
            Toastr::success('Popular Place updated successfully!', 'Success');
            return redirect()->route('admin.popularPlaces.index');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PopularPlace $popularPlace)
    {
        try {
            $this->popularPlacesUseCase->deletePopularPlace($popularPlace);
            Toastr::success('The Popular Place  Deleted successfully!', 'Delete');
            return redirect()->route('admin.popularPlaces.index');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }
}
