<?php

namespace App\Http\Controllers\Api\User;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\Event\DayRequest;
use App\Rules\CheckIfExistsInFavoratblesRule;
use App\Rules\CheckIfNotExistsInFavoratblesRule;
use App\Rules\CheckUserInterestExistsRule;
use App\Rules\CheckUserInterestRule;
use App\UseCases\Api\User\EventApiUseCase;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class EventApiController extends Controller
{
    protected $eventApiUseCase;

    public function __construct(EventApiUseCase $eventApiUseCase) {

        $this->eventApiUseCase = $eventApiUseCase;

    }

    public function index()
    {
        try{
            $events = $this->eventApiUseCase->allEvents();
            return ApiResponse::sendResponse(200, 'Events Retrieved Successfully', $events);
        } catch (\Exception $e) {
            return ApiResponse::sendResponse(Response::HTTP_BAD_REQUEST, "Something Went Wrong", $e->getMessage());
        }
    }

    public function activeEvents()
    {
        try{
            $events = $this->eventApiUseCase->activeEvents();
            return ApiResponse::sendResponse(200, 'Active Events Retrieved Successfully', $events);
        } catch (\Exception $e) {
            return ApiResponse::sendResponse(Response::HTTP_BAD_REQUEST, "Something Went Wrong", $e->getMessage());
        }
    }

    public function event(Request $request)
    {
        $id = $request->event_id;
        $validator = Validator::make(['event_id' => $id], [
            'event_id' => 'required|exists:events,id',
        ]);

        if ($validator->fails()) {
            return ApiResponse::sendResponse(Response::HTTP_BAD_REQUEST, "Something Went Wrong", $validator->errors());
        }
        try{
            $events = $this->eventApiUseCase->event($id);
            return ApiResponse::sendResponse(200, 'Active Events Retrieved Successfully', $events);
        } catch (\Exception $e) {
            return ApiResponse::sendResponse(Response::HTTP_BAD_REQUEST, "Something Went Wrong", $e->getMessage());
        }
    }

    public function dateEvents(DayRequest $request)
    {

        try{
            $events = $this->eventApiUseCase->dateEvents($request->validated());
            return ApiResponse::sendResponse(200, ' Events of specific date Retrieved Successfully', $events);
        } catch (\Exception $e) {
            return ApiResponse::sendResponse(Response::HTTP_BAD_REQUEST, "Something Went Wrong", $e->getMessage());
        }

    }

    public function interest(Request $request)
    {
        $id = $request->event_id;
        $validator = Validator::make(['event_id' => $id], [
            'event_id' => ['required','exists:events,id',new CheckUserInterestRule('App\Models\Event')],
        ]);


        if ($validator->fails()) {
            return ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST,  $validator->errors()->messages()['event_id'][0]);
        }
        try{
            $events = $this->eventApiUseCase->interestEvent($id);
            return ApiResponse::sendResponse(200, 'You Add Event in Interest  Successfully', $events);
        } catch (\Exception $e) {
            return ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST, $e->getMessage());
        }
    }

    public function disinterest(Request $request)
    {
        $id = $request->event_id;
        $validator = Validator::make(['event_id' => $id], [
            'event_id' => ['required','exists:events,id',new CheckUserInterestExistsRule('App\Models\Event')],
        ]);


        if ($validator->fails()) {
            return ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST,  $validator->errors()->messages()['event_id'][0]);
        }
        try{
            $events = $this->eventApiUseCase->disinterestEvent($id);
            return ApiResponse::sendResponse(200, 'You delete Event in Interest  Successfully', $events);
        } catch (\Exception $e) {
            return ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST, $e->getMessage());
        }
    }

    public function favorite(Request $request)
    {

        $id = $request->event_id;
        $validator = Validator::make(['event_id' => $id], [
            'event_id' => ['required','exists:events,id',new CheckIfExistsInFavoratblesRule('App\Models\Event')],
        ]);


        if ($validator->fails()) {
            return ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST,  $validator->errors()->messages()['event_id'][0]);
        }
        try{
            $events = $this->eventApiUseCase->favorite($id);
            return ApiResponse::sendResponse(200, 'You Add Event in favorite  Successfully', $events);
        } catch (\Exception $e) {
            return ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST, $e->getMessage());
        }
    }

    public function deleteFavorite(Request $request)
    {
        $id = $request->event_id;
        $validator = Validator::make(['event_id' => $id], [
            'event_id' => ['required','exists:events,id',new CheckIfNotExistsInFavoratblesRule('App\Models\Event')],
        ]);


        if ($validator->fails()) {
            return ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST,  $validator->errors()->messages()['event_id'][0]);
        }
        try{
            $events = $this->eventApiUseCase->deleteFavorite($id);
            return ApiResponse::sendResponse(200, 'You delete Event from favorite  Successfully', $events);
        } catch (\Exception $e) {
            return ApiResponse::sendResponseError(Response::HTTP_BAD_REQUEST, $e->getMessage());
        }

    }
}
