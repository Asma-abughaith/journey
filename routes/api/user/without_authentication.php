<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\CategoryApiController;
use App\Http\Controllers\Api\User\PlaceApiController;
use  App\Validation\CategoryExistsRule;
use App\Http\Controllers\Api\User\SubCategoryApiController;



Route::get('all-categories', [CategoryApiController::class, 'index'])->name('categories');

Route::get('places/category/{category_id}', [CategoryApiController::class, 'categoryPlaces'])
    ->name('category.places');

Route::get('place/{place_id}', [PlaceApiController::class, 'singlePlaces'])
    ->name('place');

Route::get('places/subcategory/{subcategory_id}', [SubCategoryApiController::class, 'singleSubCategory'])
    ->name('subcategories.places');

Route::fallback(function () {
    return response()->json(['msg'=>'this url not exists in this project walaa 7abibi fix the url :) ']);
});

