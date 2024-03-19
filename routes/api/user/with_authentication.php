<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\UserProfileController;
use App\Http\Controllers\Api\User\PlaceApiController;
use App\Http\Controllers\Api\User\TripApiController;

Route::get('/user/profile', [UserProfileController::class, 'userDetails'])->name('user.profile');
Route::post('favorite/place/{place_id?}', [PlaceApiController::class, 'createFavoritePlace']);
Route::delete('favorite/place/{place_id?}/delete', [PlaceApiController::class, 'deleteFavoritePlace']);
Route::post('visited/place/{place_id?}', [PlaceApiController::class, 'createVisitedPlace']);
Route::delete('visited/place/{place_id?}/delete', [PlaceApiController::class, 'deleteVisitedPlace']);


// All Routes For Trip
Route::group(['prefix' => 'trip'], function () {
    Route::get('/tags', [TripApiController::class, 'tags']);
    Route::get('/', [TripApiController::class, 'index']);
    Route::post('/create', [TripApiController::class, 'create']);
    Route::post('/join/{trip_id?}', [TripApiController::class, 'join']);
    Route::delete('/join/cancel/{trip_id?}',[TripApiController::class, 'cancelJoin']);
});
