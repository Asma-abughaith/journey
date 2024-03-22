<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Rules\CheckIfExistsInFavoratblesRule;
use App\Rules\CheckIfExistsInReviewsRule;
<<<<<<< Updated upstream
<<<<<<< Updated upstream
use App\Rules\CheckIfExistsInToUpdateReviewsRule;
=======
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
use App\Rules\CheckIfNotExistsInFavoratblesRule;
use App\Rules\CheckUserTripExistsRule;
use App\UseCases\Api\User\TripApiUseCase;
use Illuminate\Http\Response;
use App\Helpers\ApiResponse;
use App\Http\Requests\Api\User\Trip\AcceptCancelUserRequest;
use App\Http\Requests\Api\User\Trip\CreateTripRequest;
use App\Rules\CheckAgeGenderExistenceRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
            $trips = $this->tripApiUseCase->trips();
            return ApiResponse::sendResponse(200, __('app.trips-retrieved-successfully'), $trips);
        } catch (\Exception $e) {
            return ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST,  $e->getMessage());
        }
    }

    public function tags()
    {
        try {
            $tags = $this->tripApiUseCase->tags();
            return ApiResponse::sendResponse(200, __('app.tags-retrieved-successfully'), $tags);
        } catch (\Exception $e) {
            return ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST,  $e->getMessage());
        }
    }

    public function create(CreateTripRequest $request)
    {
        try {
            $createTrip = $this->tripApiUseCase->createTrip($request);
            return ApiResponse::sendResponse(200, __('app.trip-created-successfully'), $createTrip);
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
            $this->tripApiUseCase->joinTrip($id);
            return ApiResponse::sendResponse(200, __('app.you-join-to-trip-successfully'), []);
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
            $this->tripApiUseCase->cancelJoinTrip($id);
            return ApiResponse::sendResponse(200, __('app.you-are-left-from-the-trip-successfully'), []);
        } catch (\Exception $e) {
            return ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST,  $e->getMessage());
        }
    }

    public function privateTrips()
    {
        try {
            $trips = $this->tripApiUseCase->privateTrips();
            return ApiResponse::sendResponse(200, __('app.trips-retrieved-successfully'), $trips);
        } catch (\Exception $e) {
            return ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST,  $e->getMessage());
        }
    }

    public function tripDetails(Request $request)
    {
        try {
            $details = $this->tripApiUseCase->tripDetails($request->trip_id);
            return ApiResponse::sendResponse(200, __('app.trips-details-retrieved-successfully'), $details);
        } catch (\Exception $e) {
            return ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST,  $e->getMessage());
        }
    }

    public function acceptCancel(AcceptCancelUserRequest $request)
    {
        $validator = Validator::make(
            ['status' => $request->status],
            ['status' => ['required', Rule::in(['accept', 'cancel'])],]
        );

        if ($validator->fails()) {
            return ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST, $validator->errors()->first('status'));
        }

        try {
            $this->tripApiUseCase->changeStatus($request);
            return ApiResponse::sendResponse(200, __('app.the-status-change-successfully'), []);
        } catch (\Exception $e) {
            return ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST,  $e->getMessage());
        }
    }

    public function favorite(Request $request)
    {
        $id = $request->trip_id;
        $validator = Validator::make(['trip_id' => $id], [
            'trip_id' => ['required', 'exists:trips,id', new CheckIfExistsInFavoratblesRule('App\Models\Trip')],
        ]);


        if ($validator->fails()) {
            return ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST,  $validator->errors()->messages()['trip_id'][0]);
        }
        try {
            $trip = $this->tripApiUseCase->favorite($id);
            return ApiResponse::sendResponse(200, 'You Add Trip in favorite  Successfully', $trip);
        } catch (\Exception $e) {
            return ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST, $e->getMessage());
        }
    }

    public function deleteFavorite(Request $request)
    {
        $id = $request->trip_id;
        $validator = Validator::make(['trip_id' => $id], [
            'trip_id' => ['required', 'exists:trips,id', new CheckIfNotExistsInFavoratblesRule('App\Models\Trip')],
        ]);


        if ($validator->fails()) {
            return ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST,  $validator->errors()->messages()['trip_id'][0]);
        }
        try {
            $trip = $this->tripApiUseCase->deleteFavorite($id);
            return ApiResponse::sendResponse(200, 'You Add Trip in favorite  Successfully', $trip);
        } catch (\Exception $e) {
            return ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST, $e->getMessage());
        }
    }

    public function addReview(Request $request)
    {
        $validator = Validator::make([
            'trip_id' => $request->trip_id,
            'rating'=>$request->rating,
            'comment'=>$request->comment
            ], [
            'trip_id' => ['required','exists:trips,id',new CheckIfExistsInReviewsRule('App\Models\Trip')],
            'rating'=>['required','numeric'],
            'comment'=>['nullable','string']
        ]);


        if ($validator->fails()) {
            return ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST,  $validator->errors()->messages()['trip_id'][0]);
        }
        try{
            $trip = $this->tripApiUseCase->addReview($validator->validated());
            return ApiResponse::sendResponse(200, 'You Add review in trip Successfully', $trip);
        } catch (\Exception $e) {
            return ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST, $e->getMessage());
        }

    }

<<<<<<< Updated upstream
<<<<<<< Updated upstream
    public function updateReview(Request $request)
    {

        $validator = Validator::make([
            'trip_id' => $request->trip_id,
            'rating'=>$request->rating,
            'comment'=>$request->comment
        ], [
            'trip_id' => ['required','exists:trips,id',new CheckIfExistsInToUpdateReviewsRule('App\Models\Trip')],
            'rating'=>['required','numeric'],
=======
=======
>>>>>>> Stashed changes
    public function addReview(Request $request)
    {
        $id = $request->trip_id;
        $validator = Validator::make(['trip_id' => $id], [
            'trip_id' => ['required','exists:trips,id',new CheckIfExistsInReviewsRule('App\Models\Trip')],
            'rating'=>['required,numeric'],
<<<<<<< Updated upstream
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
            'comment'=>['nullable','string']
        ]);


        if ($validator->fails()) {
<<<<<<< Updated upstream
<<<<<<< Updated upstream
            return ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST,  $validator->errors()->messages());
        }
        try{
            $trip = $this->tripApiUseCase->updateReview($validator->validated());
            return ApiResponse::sendResponse(200, 'You update review in trip Successfully', $trip);
=======
=======
>>>>>>> Stashed changes
            return ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST,  $validator->errors()->messages()['trip_id'][0]);
        }
        try{
            dd($validator);
            $trip = $this->tripApiUseCase->addReview($id);
            return ApiResponse::sendResponse(200, 'You Add review in trip Successfully', $trip);
<<<<<<< Updated upstream
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
        } catch (\Exception $e) {
            return ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST, $e->getMessage());
        }

    }
<<<<<<< Updated upstream
<<<<<<< Updated upstream

    public function deleteReview(Request $request)
    {
        $validator = Validator::make([
            'trip_id' => $request->trip_id,
        ], [
            'trip_id' => ['required','exists:trips,id',new CheckIfExistsInToUpdateReviewsRule('App\Models\Trip')],
        ]);

        if ($validator->fails()) {
            return ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST,  $validator->errors()->messages());
        }
        try{
            $trip = $this->tripApiUseCase->deleteReview($validator->validated());
            return ApiResponse::sendResponse(200, 'You delete the review in trip Successfully', $trip);
        } catch (\Exception $e) {
            return ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST, $e->getMessage());
        }
    }
=======
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
}
