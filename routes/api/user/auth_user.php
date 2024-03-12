<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\AuthUser\AuthUserController;
use App\Http\Controllers\Api\User\AuthUser\EmailVerificationNotificationController;
use App\Http\Controllers\Api\User\AuthUser\NewPasswordController;
use App\Http\Controllers\Api\User\AuthUser\PasswordResetLinkController;
use App\Http\Controllers\Api\User\AuthUser\VerifyEmailController;

Route::post('/login', [AuthUserController::class, 'login'])->name('login');
Route::post('/register', [AuthUserController::class, 'register'])->name('register');
Route::post('/logout', [AuthUserController::class, 'logout'])->middleware('auth:api')->name('logout');

Route::get('/email/verify/{id}/{hash}', VerifyEmailController::class)->middleware('signed')->name('verification.verify');
Route::post('/email/verification-notification', EmailVerificationNotificationController::class)->name('verification.send')->middleware('auth:api');


Route::post('/forgot-password', PasswordResetLinkController::class)->name('password.email');
Route::get('user/reset-password/{token}', [AuthUserController::class, 'resetPassword'])->name('password.reset');
Route::post('/reset-password', NewPasswordController::class)->name('password.store');
