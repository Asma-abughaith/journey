<?php

use Illuminate\Support\Facades\Route;

Route::get('/users',function(){
    dd('users');

})->name('users');
