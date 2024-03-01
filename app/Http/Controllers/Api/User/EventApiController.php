<?php

namespace App\Http\Controllers\Api\User;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\Event\DayRequest;
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
}