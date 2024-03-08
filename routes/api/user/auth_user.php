<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\AuthUser\AuthUserController;


Route::post('/register', [AuthUserController::class, 'register'])->name('register');
Route::post('/login', [AuthUserController::class, 'login'])->name('login');
Route::get('{lang}/email/verify/{id}/{hash}', [AuthUserController::class,'checkEmailVerification'])->middleware('signed')->name('verification.verify');

