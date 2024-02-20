<?php

namespace App\Http\Controllers\Api\User;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;

use App\UseCases\Api\User\PlaceApiUseCase;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class PlaceApiController extends Controller
{
    protected $placeApiUseCase;

    public function __construct(PlaceApiUseCase $placeApiUseCase) {

        $this->placeApiUseCase = $placeApiUseCase;

    }
    /**
     * Display a listing of the resource.
     */

    public function categoryPlaces(Request $request)
    {
        $id = $request->category_id;
        $validator = Validator::make(['category_id' => $id], [
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return ApiResponse::sendResponse(Response::HTTP_BAD_REQUEST, "Something Went Wrong", $validator->errors());
        }
        try{
            $allPlaces = $this->placeApiUseCase->allPlacesByCategory($id);

            return ApiResponse::sendResponse(200, 'Places and SubCategories by Category id Retrieved Successfully', $allPlaces);
        } catch (\Exception $e) {
            return ApiResponse::sendResponse(Response::HTTP_BAD_REQUEST, "Something Went Wrong", $e->getMessage());
        }
    }


    public function singlePlaces(Request $request)
    {
        $id = $request->place_id;
        $validator = Validator::make(['place_id' => $id], [
            'place_id' => 'required|exists:places,id',
        ]);

        if ($validator->fails()) {
            return ApiResponse::sendResponse(Response::HTTP_BAD_REQUEST, "Something Went Wrong", $validator->errors());
        }
        try{
            $allPlaces = $this->placeApiUseCase->singlePlace($id);

            return ApiResponse::sendResponse(200, 'Places Retrieved by id Successfully', $allPlaces);
        } catch (\Exception $e) {
            return ApiResponse::sendResponse(Response::HTTP_BAD_REQUEST, "Something Went Wrong", $e->getMessage());
        }
    }



}
