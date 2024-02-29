<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Admin\Plan\StorePlanRequest;
use App\Http\Requests\Web\Admin\Plan\UpdatePlanRequest;
use App\Interfaces\Presenters\Web\Admin\PlanPresenter;
use App\Models\Plan;
use App\UseCases\Web\Admin\PlanUseCase;
use Brian2694\Toastr\Facades\Toastr;

class PlanController extends Controller
{
    protected $planPresenter;
    protected $planUseCase;

    public function __construct( PlanPresenter $planPresenter, PlanUseCase $planUseCase) {
        $this->planPresenter = $planPresenter;
        $this->planUseCase = $planUseCase;

//        $this->middleware('checkPermission:view plans')->only(['index']);
//        $this->middleware('checkPermission:create plan')->only(['create', 'store']);
//        $this->middleware('checkPermission:view plans')->only(['show']);
//        $this->middleware('checkPermission:edit plan')->only(['edit', 'update']);
//        $this->middleware('checkPermission:delete plan')->only(['destroy']);

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $allPlans = $this->planUseCase->getAllPlans();
            $plans = $this->planPresenter->presentAllPlan($allPlans);
            return view('admin.plans.index',compact('plans'));
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
        return view('admin.plans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlanRequest $request)
    {
        try {
            $this->planUseCase->createPlan( $request->validated());
            Toastr::success(__('validation.msg.plan-created-successfully!'), __('validation.msg.success'));
            return redirect()->route('admin.plans.index');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Plan $plan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plan $plan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlanRequest $request, Plan $plan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan $plan)
    {
        //
    }
}
