<?php

namespace App\Http\Controllers\Api\User;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\Plan\CreatePlanApiRequest;
use App\Http\Requests\Api\User\Plan\UpdatePlanApiRequest;
use App\Rules\CheckIfPlanBelongsToUser;
use App\UseCases\Api\User\PlanApiUseCase;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class PlanApiController extends Controller
{
    protected $planApiUseCase;

    public function __construct(PlanApiUseCase $planApiUseCase) {

        $this->planApiUseCase = $planApiUseCase;

    }

    public function index()
    {
        try {
            $plans = $this->planApiUseCase->allPlans();
            return ApiResponse::sendResponse(200, __('app.plans-retrieved-successfully'), $plans);
        } catch (\Exception $e) {
            return ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST,  $e->getMessage());
        }
    }


    public function create(CreatePlanApiRequest $request)
    {
        $validatedData = $request->validated();

        try {
            $createTrip = $this->planApiUseCase->createPlan($validatedData);
            return ApiResponse::sendResponse(200, __('app.plan-created-successfully'), $createTrip);
        } catch (\Exception $e) {
            return ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST,  $e->getMessage());
        }

    }

    public function update(UpdatePlanApiRequest $request)
    {
        $validatedData = $request->validated();

        try {
            $createTrip = $this->planApiUseCase->updatePlan($validatedData);
            return ApiResponse::sendResponse(200, __('app.plan-updated-successfully'), $createTrip);
        } catch (\Exception $e) {
            return ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST,  $e->getMessage());
        }

    }

    public function destroy(Request $request)
    {
        $id = $request->plan_id;
        $validator = Validator::make(['plan_id' => $id], [
            'plan_id' => ['required', 'exists:plans,id',new CheckIfPlanBelongsToUser()],
        ]);

        if ($validator->fails()) {
            return ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST,  $validator->errors()->messages()['plan_id'][0]);
        }

        try {
            $createTrip = $this->planApiUseCase->deletePlan($id);
            return ApiResponse::sendResponse(200, __('app.plan-deleted-successfully'), $createTrip);
        } catch (\Exception $e) {
            return ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST,  $e->getMessage());
        }

    }



}
