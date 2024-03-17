<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Rules\CheckUserTripExistsRule;
use App\UseCases\Api\User\TripApiUseCase;
use Illuminate\Http\Response;
use App\Helpers\ApiResponse;
use App\Http\Requests\Api\User\Trip\CreateTripRequest;
use App\Rules\CheckAgeGenderExistenceRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TripApiController extends Controller
{
    protected $tripApiUseCase;

    public function __construct(TripApiUseCase $tripApiUseCase)
    {
        $this->tripApiUseCase = $tripApiUseCase;
    }

    public function index()
    {
        try {
            $tags = $this->tripApiUseCase->trips();
            return ApiResponse::sendResponse(200, 'Trips Retrieved Successfully', $tags);
        } catch (\Exception $e) {
            return ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST,  $e->getMessage());
        }
    }

    public function tags()
    {
        try {
            $tags = $this->tripApiUseCase->tags();
            return ApiResponse::sendResponse(200, 'Tags Retrieved Successfully', $tags);
        } catch (\Exception $e) {
            return ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST,  $e->getMessage());
        }
    }

    public function create(CreateTripRequest $request)
    {
        try {
            $createTrip = $this->tripApiUseCase->createTrip($request);
            return ApiResponse::sendResponse(200, 'Trip Created Successfully', $createTrip);
        } catch (\Exception $e) {
            return ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST,  $e->getMessage());
        }
    }

    public function join(Request $request)
    {
        $id = $request->trip_id;

        $validator = Validator::make(['trip_id' => $id], [
            'trip_id' => ['required', 'exists:trips,id', new CheckAgeGenderExistenceRule()],
        ]);

        if ($validator->fails()) {
            return ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST,  $validator->errors()->messages()['trip_id'][0]);
        }

        try {
            $cancelJoinTrip = $this->tripApiUseCase->joinTrip($id);
            return ApiResponse::sendResponse(200, 'You Join To Trip Successfully', []);
        } catch (\Exception $e) {
            return ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST,  $e->getMessage());
        }
    }

    public function cancelJoin(Request $request)
    {
        $id = $request->trip_id;

        $validator = Validator::make(['trip_id' => $id], [
            'trip_id' => ['required', 'exists:trips,id', new CheckUserTripExistsRule()],
        ]);

        if ($validator->fails()) {
            return ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST,  $validator->errors()->messages()['trip_id'][0]);
        }

        try {
            $createTrip = $this->tripApiUseCase->cancelJoinTrip($id);
            return ApiResponse::sendResponse(200, 'You Are Left From The Trip Successfully', []);
        } catch (\Exception $e) {
            return ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST,  $e->getMessage());
        }
    }
}
