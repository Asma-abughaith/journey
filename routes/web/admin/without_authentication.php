<?php

use App\Http\Controllers\Web\Admin\AdminAuth\AuthenticatedSessionController;
use App\Http\Controllers\Web\Admin\AdminAuth\NewPasswordController;
use App\Http\Controllers\Web\Admin\AdminAuth\PasswordResetLinkController;
use App\Http\Controllers\Web\Admin\AdminAuth\RegisteredUserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function (\Illuminate\Http\Request $request) {
    return view('welcome');
});


Route::get('register', [RegisteredUserController::class, 'create'])->name('register');

Route::post('register', [RegisteredUserController::class, 'store']);

Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');

Route::post('login', [AuthenticatedSessionController::class, 'store']);

Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');

Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');

Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
