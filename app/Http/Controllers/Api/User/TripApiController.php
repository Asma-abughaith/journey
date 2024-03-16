<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\UseCases\Api\User\TripApiUseCase;
use Illuminate\Http\Response;
use App\Helpers\ApiResponse;
use App\Http\Requests\Api\User\Trip\CreateTripRequest;

class TripApiController extends Controller
{
    protected $tripApiUseCase;

    public function __construct(TripApiUseCase $tripApiUseCase)
    {
        $this->tripApiUseCase = $tripApiUseCase;
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
}
