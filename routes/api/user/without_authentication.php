<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\User\CategoryApiController;



Route::get('all-categories', [CategoryApiController::class, 'index'])->name('categories');


Route::fallback(function () {
    return response()->json(['msg'=>'this url not exists in this project walaa 7abibi fix the url :) ']);
});

