<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\CategoryApiController;
use App\Http\Controllers\Api\User\PlaceApiController;
use  App\Validation\CategoryExistsRule;



Route::get('all-categories', [CategoryApiController::class, 'index'])->name('categories');

Route::get('places/category/{category_id}', [CategoryApiController::class, 'categoryPlaces'])
    ->name('category.places');

Route::get('place/{place_id}', [PlaceApiController::class, 'singlePlaces'])
    ->name('place');

Route::fallback(function () {
    return response()->json(['msg'=>'this url not exists in this project walaa 7abibi fix the url :) ']);
});

