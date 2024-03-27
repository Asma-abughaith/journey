<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\UserProfileController;
use App\Http\Controllers\Api\User\PlaceApiController;
use App\Http\Controllers\Api\User\TripApiController;
use App\Http\Controllers\Api\User\EventApiController;
use App\Http\Controllers\Api\User\VolunteeringApiController;
use App\Http\Controllers\Api\User\PlanApiController;
use App\Http\Controllers\Api\User\PostApiController;


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
    Route::get('/details/{trip_id}', [TripApiController::class, 'tripDetails']);
    // ============ private Trips ============
    Route::get('/private', [TripApiController::class, 'privateTrips']);
    Route::post('/user/{status?}', [TripApiController::class, 'acceptCancel']);

    Route::post('/favorite/{trip_id?}', [TripApiController::class, 'favorite']);
    Route::delete('/favorite/{trip_id?}/delete', [TripApiController::class, 'deleteFavorite']);

    Route::post('add/review/{trip_id?}', [TripApiController::class, 'addReview']);
    Route::post('update/review/{trip_id?}', [TripApiController::class, 'updateReview']);
    Route::delete('delete/review/{trip_id?}', [TripApiController::class, 'deleteReview']);
    Route::get('all/reviews/{trip_id?}', [TripApiController::class, 'reviews']);

    Route::get('review/{status?}/{review_id?}', [TripApiController::class, 'likeDislike']);

    Route::delete('/delete/{trip_id?}', [TripApiController::class, 'remove']);
    Route::post('/update/{trip_id?}', [TripApiController::class, 'update']);
});

// All Routes For event
Route::group(['prefix' => 'event'], function () {
    Route::post('/interest/{event_id?}', [EventApiController::class, 'interest']);
    Route::delete('/disinterest/{event_id?}', [EventApiController::class, 'disinterest']);
    Route::post('/favorite/{event_id?}', [EventApiController::class, 'favorite']);
    Route::delete('/favorite/{event_id?}/delete', [EventApiController::class, 'deleteFavorite']);
});

// All Routes For event
Route::group(['prefix' => 'volunteering'], function () {
    Route::post('/interest/{volunteering_id?}', [VolunteeringApiController::class, 'interest']);
    Route::delete('/disinterest/{volunteering_id?}', [VolunteeringApiController::class, 'disinterest']);
    Route::post('/favorite/{volunteering_id?}', [VolunteeringApiController::class, 'favorite']);
    Route::delete('/favorite/{volunteering_id?}/delete', [VolunteeringApiController::class, 'deleteFavorite']);
});

// All Routes For Plan
Route::group(['prefix' => 'plan'], function () {
    Route::get('/', [PlanApiController::class, 'index']);
    Route::post('/create', [PlanApiController::class, 'create']);
    Route::post('/update/{plan_id?}', [PlanApiController::class, 'update']);
    Route::delete('/{plan_id?}/delete', [PlanApiController::class, 'destroy']);
    Route::get('/{plan_id?}', [PlanApiController::class, 'show']);
});

// All Routes For Plan
Route::group(['prefix' => 'post'], function () {
    Route::get('/', [PostApiController::class, 'index']);
    Route::post('/store', [PostApiController::class, 'store']);
    Route::post('/update/{post_id}', [PostApiController::class, 'update']);
    Route::get('/get/imges/{post_id}', [PostApiController::class, 'images']);
    Route::delete('/delete/{post_id}', [PostApiController::class, 'delete']);
});
