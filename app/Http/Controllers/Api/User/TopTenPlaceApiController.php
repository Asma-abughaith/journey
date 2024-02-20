<?php

namespace App\Http\Controllers\Api\User;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\UseCases\Api\User\TopTenPlaceApiUseCase;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class TopTenPlaceApiController extends Controller
{
    protected $topTenPlaceApiUseCase;

    public function __construct(TopTenPlaceApiUseCase $topTenPlaceApiUseCase) {

        $this->topTenPlaceApiUseCase = $topTenPlaceApiUseCase;

    }
    /**
     * Display a listing of the resource.
     */

    public function topTenPlaces()
    {
        try{
            $topTenPlaces = $this->topTenPlaceApiUseCase->topTenPlaces();

            return ApiResponse::sendResponse(200, 'Top Ten Places Retrieved Successfully', $topTenPlaces);
        } catch (\Exception $e) {
            return ApiResponse::sendResponse(Response::HTTP_BAD_REQUEST, "Something Went Wrong", $e->getMessage());
        }
    }
}
