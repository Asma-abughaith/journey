<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\TopTen\StoreTopTenRequest;
use App\Http\Requests\Web\Admin\TopTen\UpdateTopTenRequest;
use App\Interfaces\Presenters\Web\Admin\PlacePresenter;
use App\Interfaces\Presenters\Web\Admin\TopTenPlacePresenter;
use App\Models\TopTen;
use App\UseCases\Web\Admin\PlaceUseCase;
use App\UseCases\Web\Admin\TopTenPlaceUseCase;
use Brian2694\Toastr\Facades\Toastr;

class TopTenPlaceController extends Controller
{
    protected $topTenPlacesPresenter;
    protected $topTenPlacesUseCase;
    protected $placeUseCase;
    protected $placePresenter;

    public function __construct( TopTenPlacePresenter $topTenPlacesPresenter, TopTenPlaceUseCase $topTenPlacesUseCase, PlaceUseCase $placeUseCase, PlacePresenter $placePresenter) {
        $this->topTenPlacesPresenter = $topTenPlacesPresenter;
        $this->topTenPlacesUseCase = $topTenPlacesUseCase;
        $this->placePresenter = $placePresenter;
        $this->placeUseCase = $placeUseCase;

//        $this->middleware('checkPermission:view topTenPlaces')->only(['index']);
//        $this->middleware('checkPermission:create topTenPlace')->only(['create', 'store']);
//        $this->middleware('checkPermission:view topTenPlaces')->only(['show']);
//        $this->middleware('checkPermission:edit topTenPlace')->only(['edit', 'update']);
//        $this->middleware('checkPermission:delete topTenPlace')->only(['destroy']);

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $allTopTenPlaces = $this->topTenPlacesUseCase->allTopTenPlaces();
            $topTenPlaces = $this->topTenPlacesPresenter->presentAllTenPlacePlaces($allTopTenPlaces);
            return view('admin.top_ten_places.index',compact('topTenPlaces'));
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
            return view('admin.top_ten_places.create', compact('places'));
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTopTenRequest $request)
    {
        try {
            $this->topTenPlacesUseCase->createTopTenPlace($request->validated());
            Toastr::success('Top Ten Place created successfully!', 'Success');
            return redirect()->route('admin.topTenPlaces.index');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withErrors($request->errors)->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(TopTen $topTen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $allPlaces = $this->placeUseCase->allPlaces();
            $places = $this->placePresenter->presentAllPlacesForAnoterController($allPlaces);


            $topTen = $this->topTenPlacesUseCase->getTopTenPlaceById($id);
            $topTen = $this->topTenPlacesPresenter->presentTenPlacePlace($topTen);

            return view('admin.top_ten_places.edit',compact('topTen','places'));
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTopTenRequest $request,  $id)
    {
        try {
            $this->topTenPlacesUseCase->updateTopTenPlace($id, $request->validated());
            Toastr::success('Top Ten Place updated successfully!', 'Success');
            return redirect()->route('admin.topTenPlaces.index');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $this->topTenPlacesUseCase->deleteTopTenPlace($id);
            Toastr::success('The Top Ten Place  Deleted successfully!', 'Delete');
            return redirect()->route('admin.topTenPlaces.index');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }
}
