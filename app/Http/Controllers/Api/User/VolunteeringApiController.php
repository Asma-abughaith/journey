<?php

namespace App\Http\Controllers\Api\User;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\Event\DayRequest;
use App\Rules\CheckUserInterestExistsRule;
use App\Rules\CheckUserInterestRule;
use App\UseCases\Api\User\VolunteeringApiUseCase;
use App\UseCases\Web\Admin\VolunteeringUseCase;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class VolunteeringApiController extends Controller
{
    protected $volunteeringApiUseCase;

    public function __construct(VolunteeringApiUseCase $volunteeringApiUseCase) {

        $this->volunteeringApiUseCase = $volunteeringApiUseCase;

    }

    public function index()
    {
        try{
            $volunteering = $this->volunteeringApiUseCase->allVolunteerings();
            return ApiResponse::sendResponse(200, 'Volunteering Retrieved Successfully', $volunteering);
        } catch (\Exception $e) {
            return ApiResponse::sendResponse(Response::HTTP_BAD_REQUEST, "Something Went Wrong", $e->getMessage());
        }
    }

    public function activeVolunteerings()
    {
        try{
            $volunteering = $this->volunteeringApiUseCase->activeVolunteerings();
            return ApiResponse::sendResponse(200, 'Active Volunteering Retrieved Successfully', $volunteering);
        } catch (\Exception $e) {
            return ApiResponse::sendResponse(Response::HTTP_BAD_REQUEST, "Something Went Wrong", $e->getMessage());
        }
    }

    public function volunteering(Request $request)
    {
        $id = $request->volunteering_id;
        $validator = Validator::make(['volunteering_id' => $id], [
            'volunteering_id' => 'required|exists:volunteerings,id',
        ]);

        if ($validator->fails()) {
            return ApiResponse::sendResponse(Response::HTTP_BAD_REQUEST, "Something Went Wrong", $validator->errors());
        }
        try{
            $volunteering = $this->volunteeringApiUseCase->Volunteering($id);
            return ApiResponse::sendResponse(200, 'Active Events Retrieved Successfully', $volunteering);
        } catch (\Exception $e) {
            return ApiResponse::sendResponse(Response::HTTP_BAD_REQUEST, "Something Went Wrong", $e->getMessage());
        }
    }

    public function dateVolunteering(DayRequest $request)
    {

        try{
            $volunteering = $this->volunteeringApiUseCase->dateVolunteerings($request->validated());
            return ApiResponse::sendResponse(200, ' Events of specific date Retrieved Successfully', $volunteering);
        } catch (\Exception $e) {
            return ApiResponse::sendResponse(Response::HTTP_BAD_REQUEST, "Something Went Wrong", $e->getMessage());
        }

    }

    public function interest(Request $request)
    {

        $id = $request->volunteering_id;
        $validator = Validator::make(['volunteering_id' => $id], [
            'volunteering_id' =>  ['required','exists:volunteerings,id',new CheckUserInterestRule('App\Models\Volunteering')],
        ]);


        if ($validator->fails()) {
            return ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST,  $validator->errors()->messages()['volunteering_id'][0]);
        }
        try{
            $events = $this->volunteeringApiUseCase->interestVolunteering($id);
            return ApiResponse::sendResponse(200, 'You Add Volunteering in Interest  Successfully', $events);
        } catch (\Exception $e) {
            return ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST, $e->getMessage());
        }
    }

    public function disinterest(Request $request)
    {
        $id = $request->volunteering_id;
        $validator = Validator::make(['volunteering_id' => $id], [
            'volunteering_id' => ['required','exists:volunteerings,id',new CheckUserInterestExistsRule('App\Models\Volunteering')],
        ]);


        if ($validator->fails()) {
            return ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST,  $validator->errors()->messages()['volunteering_id'][0]);
        }
        try{
            $events = $this->volunteeringApiUseCase->disinterestVolunteering($id);
            return ApiResponse::sendResponse(200, 'You delete volunteering in Interest  Successfully', $events);
        } catch (\Exception $e) {
            return ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST, $e->getMessage());
        }
    }
}
