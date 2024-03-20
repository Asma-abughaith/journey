<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\UserProfileController;
use App\Http\Controllers\Api\User\PlaceApiController;
use App\Http\Controllers\Api\User\TripApiController;
use App\Http\Controllers\Api\User\EventApiController;
use App\Http\Controllers\Api\User\VolunteeringApiController;

Route::get('/user/profile', [UserProfileController::class, 'userDetails'])->name('user.profile');
Route::post('favorite/place/{place_id?}', [PlaceApiController::class, 'createFavoritePlace']);
Route::delete('favorite/place/{place_id?}/delete', [PlaceApiController::class, 'deleteFavoritePlace']);
Route::post('visited/place/{place_id?}', [PlaceApiController::class, 'createVisitedPlace']);
Route::delete('visited/place/{place_id?}/delete', [PlaceApiController::class, 'deleteVisitedPlace']);


// All Routes For Trip
Route::group(['prefix' => 'trip'], function () {
    // ============ public Trips ============
    Route::get('/tags', [TripApiController::class, 'tags']);
    Route::get('/', [TripApiController::class, 'index']);
    Route::post('/create', [TripApiController::class, 'create']);
    Route::post('/join/{trip_id?}', [TripApiController::class, 'join']);
    Route::delete('/join/cancel/{trip_id?}', [TripApiController::class, 'cancelJoin']);
    // ============ private Trips ============
    Route::get('/private', [TripApiController::class, 'privateTrips']);
    Route::get('/private/trip/details/{trip_id}', [TripApiController::class, 'tripDetails']);
});

// All Routes For event
Route::group(['prefix' => 'event'], function () {
    Route::post('/interest/{event_id?}', [EventApiController::class, 'interest']);
    Route::delete('/disinterest/{event_id?}', [EventApiController::class, 'disinterest']);
});

// All Routes For event
Route::group(['prefix' => 'volunteering'], function () {
    Route::post('/interest/{volunteering_id?}', [VolunteeringApiController::class, 'interest']);
    Route::delete('/disinterest/{volunteering_id?}', [VolunteeringApiController::class, 'disinterest']);
});
