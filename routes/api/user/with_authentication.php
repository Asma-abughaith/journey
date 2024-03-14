<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\UserProfileController;
use App\Http\Controllers\Api\User\PlaceApiController;

Route::get('/user/profile',[UserProfileController::class, 'userDetails'])->name('user.profile');
Route::post('favorite/place/{place_id}',[PlaceApiController::class,'createFavoritePlace']);
Route::delete('favorite/place/{place_id}/delete',[PlaceApiController::class,'deleteFavoritePlace']);

