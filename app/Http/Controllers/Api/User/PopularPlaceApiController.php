<?php

namespace App\Http\Controllers\Api\User;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\UseCases\Api\User\PopularPlaceApiUseCase;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PopularPlaceApiController extends Controller
{
    protected $popularPlaceApiUseCase;

    public function __construct(PopularPlaceApiUseCase $popularPlaceApiUseCase) {

        $this->popularPlaceApiUseCase = $popularPlaceApiUseCase;

    }
    /**
     * Display a listing of the resource.
     */

    public function topTenPlaces()
    {
        try{
            $topTenPlaces = $this->popularPlaceApiUseCase->popularPlaces();

            return ApiResponse::sendResponse(200, 'Popular Places Retrieved Successfully', $topTenPlaces);
        } catch (\Exception $e) {
            return ApiResponse::sendResponse(Response::HTTP_BAD_REQUEST, "Something Went Wrong", $e->getMessage());
        }
    }
}
