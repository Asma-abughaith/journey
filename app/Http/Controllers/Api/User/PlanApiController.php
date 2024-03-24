<?php

namespace App\Http\Controllers\Api\User;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\Plan\CreatePlanApiRequest;
use App\Models\Plan;
use App\UseCases\Api\User\PlanApiUseCase;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class PlanApiController extends Controller
{
    protected $planApiUseCase;

    public function __construct(PlanApiUseCase $planApiUseCase) {

        $this->planApiUseCase = $planApiUseCase;

    }


    public function create(CreatePlanApiRequest $request)
    {
        // Validated data will be available in the $request->validated() method
        $validatedData = $request->validated();

        try {
            $createTrip = $this->planApiUseCase->createPlan($validatedData);
            return ApiResponse::sendResponse(200, __('app.plan-created-successfully'), $createTrip);
        } catch (\Exception $e) {
            return ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST,  $e->getMessage());
        }

    }



}
