<?php

namespace App\Http\Controllers\Api\User;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;

use App\Http\Requests\Api\User\Place\CreateFavoritePlaceRequest;
use App\Rules\CheckIfExistsInFavoratblesRule;
use App\Rules\CheckIfExistsInVistedPlaceTableRule;
use App\Rules\CheckIfNotExistsInFavoratblesRule;
use App\Rules\CheckIfNotExistsInVistedPlaceTableRule;
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

    public function createFavoritePlace(Request $request)
    {
        $id = $request->place_id;

        $validator = Validator::make(['place_id' => $id], [
            'place_id' => ['required','exists:places,id',new CheckIfExistsInFavoratblesRule('App\Models\Place')],
        ]);

        if ($validator->fails()) {
            return ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST,  $validator->errors()->messages()['place_id'][0]);
        }

        try{
            $createFavPlace = $this->placeApiUseCase->createFavoritePlace($id);

            return ApiResponse::sendResponse(200, 'Favorite Places Created  Successfully', $createFavPlace);
        } catch (\Exception $e) {
            return ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST,  $e->getMessage());
        }

    }

    public  function deleteFavoritePlace(Request $request){
        $id = $request->place_id;

        $validator = Validator::make(['place_id' => $id], [
            'place_id' => ['required','exists:places,id',new CheckIfNotExistsInFavoratblesRule('App\Models\Place')],
        ]);

        if ($validator->fails()) {
            return ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST,  $validator->errors()->messages()['place_id'][0]);
        }

        try{
            $deleteFavPlace = $this->placeApiUseCase->deleteFavoritePlace($id);
            return ApiResponse::sendResponse(200, 'Favorite Place Deleted Successfully', $deleteFavPlace);
        } catch (\Exception $e) {
            return ApiResponse::sendResponse(Response::HTTP_BAD_REQUEST, "Something Went Wrong", $e->getMessage());
        }
    }

    public function createVisitedPlace(Request $request)
    {
        $id = $request->place_id;

        $validator = Validator::make(['place_id' => $id], [
            'place_id' => ['required','exists:places,id',new CheckIfExistsInVistedPlaceTableRule()],
        ]);

        if ($validator->fails()) {
            return ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST,  $validator->errors()->messages()['place_id'][0]);
        }

        try{
            $createVisitedPlace = $this->placeApiUseCase->createVisitedPlace($id);

            return ApiResponse::sendResponse(200, 'Visited Places Created  Successfully', $createVisitedPlace);
        } catch (\Exception $e) {
            return ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST,  $e->getMessage());
        }

    }


    public  function deleteVisitedPlace(Request $request){
        $id = $request->place_id;

        $validator = Validator::make(['place_id' => $id], [
            'place_id' => ['required','exists:places,id',new CheckIfNotExistsInVistedPlaceTableRule()],
        ]);

        if ($validator->fails()) {
            return ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST,  $validator->errors()->messages()['place_id'][0]);
        }

        try{
            $deleteVisitedPlace = $this->placeApiUseCase->deleteVisitedPlace($id);
            return ApiResponse::sendResponse(200, 'delete visited Place Deleted Successfully', $deleteVisitedPlace);
        } catch (\Exception $e) {
            return ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST, $e->getMessage());
        }
    }

}
