<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\UserProfileController;

Route::get('/user/profile',[UserProfileController::class, 'userDetails'])->name('user.profile');
