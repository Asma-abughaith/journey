<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\Presenters\Web\Admin\TripPresenter;
use App\UseCases\Web\Admin\TripUseCase;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class TripController extends Controller
{
    protected $tripPresenter;
    protected $tripUseCase;

    public function __construct( TripPresenter $tripPresenter, TripUseCase $tripUseCase) {
        $this->tripPresenter = $tripPresenter;
        $this->tripUseCase = $tripUseCase;

//        $this->middleware('checkPermission:view categories')->only(['index']);
//        $this->middleware('checkPermission:create category')->only(['create', 'store']);
//        $this->middleware('checkPermission:view categories')->only(['show']);
//        $this->middleware('checkPermission:edit category')->only(['edit', 'update']);
//        $this->middleware('checkPermission:delete category')->only(['destroy']);

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $allTrips = $this->tripUseCase->getAllTrips();
            $trips = $this->tripPresenter->presentAllTrip($allTrips);
            return view('admin.trips.index',compact('trips'));
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }

    public function show($id)
    {
        try{
            $trip = $this->tripUseCase->getTrip($id);
            $trip = $this->tripPresenter->presentTrip($trip);
            return view('admin.trips.show',compact('trip'));
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $this->tripUseCase->deleteTrip($id);
            Toastr::success('You changed Trip Status So Can\'t user Join it  !', 'Delete');
            return redirect()->route('admin.trips.index');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }

}
