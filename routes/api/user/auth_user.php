<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\AuthUser\AuthUserController;


Route::post('/register', [AuthUserController::class, 'register'])->name('register');
Route::post('/login', [AuthUserController::class, 'login'])->name('login');
Route::get('email/verify/{id}/{hash}', [AuthUserController::class,'checkEmailVerification'])->middleware('signed')->name('verification.verify');
Route::post('/email/verification-notification', [AuthUserController::class,'resendEmailVerification'])->name('verification.send')->middleware('auth:api');


Route::post('/forgot-password', [AuthUserController::class,'sendRestPasswordLink'])->name('password.email');
//Route::get('user/reset-password/{token}', [AuthUserController::class, 'resetPassword'])
//    ->name('password.reset');
Route::post('reset-password', [AuthUserController::class, 'restPasswordRequest'])
    ->name('password.store');
