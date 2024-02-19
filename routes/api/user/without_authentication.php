<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\CategoryApiController;
use App\Http\Controllers\Api\User\PlaceApiController;
use  App\Validation\CategoryExistsRule;



Route::get('all-categories', [CategoryApiController::class, 'index'])->name('categories');

Route::get('places/category/{category_id}', [PlaceApiController::class, 'categoryPlaces'])
    ->name('category.places');

Route::fallback(function () {
    return response()->json(['msg'=>'this url not exists in this project walaa 7abibi fix the url :) ']);
});

