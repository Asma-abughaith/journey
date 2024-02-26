<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\CategoryApiController;
use App\Http\Controllers\Api\User\PlaceApiController;
use  App\Validation\CategoryExistsRule;
use App\Http\Controllers\Api\User\SubCategoryApiController;
use App\Http\Controllers\Api\User\TopTenPlaceApiController;
use App\Http\Controllers\Api\User\PopularPlaceApiController;
use \App\Http\Controllers\Api\User\EventApiController;



Route::get('all-categories', [CategoryApiController::class, 'index'])->name('categories');

Route::get('shuffle/all-categories', [CategoryApiController::class, 'shuffleAllCategories'])->name('categories.shuffle');

Route::get('places/category/{category_id}', [CategoryApiController::class, 'categoryPlaces'])->name('category.places');

Route::get('place/{place_id}', [PlaceApiController::class, 'singlePlaces'])->name('place');

Route::get('places/subcategory/{subcategory_id}', [SubCategoryApiController::class, 'singleSubCategory'])->name('subcategories.places');

Route::get('top-ten-places', [TopTenPlaceApiController::class, 'topTenPlaces'])->name('topTen.places');

Route::get('popular/places', [PopularPlaceApiController::class, 'topTenPlaces'])->name('popular.places');

Route::get('all/events', [EventApiController::class, 'index'])->name('events');

Route::get('all/active/events', [EventApiController::class, 'activeEvents'])->name('active.events');

Route::get('event/{event_id}', [EventApiController::class, 'event'])->name('single.events');

Route::get('date/events', [EventApiController::class, 'dateEvents'])->name('date.events');

Route::fallback(function () {
    return response()->json(['msg'=>'this url not exists in this project walaa 7abibi fix the url :) ']);
});

