<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Admin\AdminAuth\ConfirmablePasswordController;
use App\Http\Controllers\Web\Admin\AdminAuth\EmailVerificationNotificationController;
use App\Http\Controllers\Web\Admin\AdminAuth\EmailVerificationPromptController;
use App\Http\Controllers\Web\Admin\AdminAuth\PasswordController;
use App\Http\Controllers\Web\Admin\AdminAuth\VerifyEmailController;
use App\Http\Controllers\Web\Admin\AdminAuth\AuthenticatedSessionController;
use App\Http\Controllers\Web\Admin\PermissionController;
use App\Http\Controllers\Web\Admin\RoleController;
use App\Http\Controllers\Web\Admin\AdminController;
use App\Http\Controllers\Web\Admin\CategoryController;
use App\Http\Controllers\Web\Admin\SubCategoryController;
use App\Http\Controllers\Web\Admin\RegionController;
use App\Http\Controllers\Web\Admin\FeatureController;
use App\Http\Controllers\Web\Admin\TagController;
use App\Http\Controllers\Web\Admin\PlaceController;

use App\Models\Admin;
use App\Http\Controllers\Web\Setting\LanguageController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/dashboard', function () {
    $admins = Admin::all()->count();
    return view('admin.dashboard', compact('admins'));
})->name('dashboard');

Route::get('verify-email', EmailVerificationPromptController::class)
    ->name('verification.notice');

Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');

Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    ->middleware('throttle:6,1')
    ->name('verification.send');

Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
    ->name('password.confirm');

Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

Route::put('password', [PasswordController::class, 'update'])->name('password.update');

Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

//routes for permissions we should hide it after finish
Route::resource('permissions', PermissionController::class);

//================= Routes For Role =================
Route::resource('roles', RoleController::class);

//================= Routes For Admins =================
Route::resource('admins', AdminController::class);

//================= Routes For Categories =================
Route::resource('categories', CategoryController::class);

//================= Routes For Categories =================
Route::get('/language/{lang}', [LanguageController::class, 'switchLanguage'])->name('language.switch');

//================= Routes For SubCategories =================
Route::resource('/sub_categories', SubCategoryController::class);

//================= Routes For Region =================
Route::resource('/regions', RegionController::class);

//================= Routes For Features =================
Route::resource('/features', FeatureController::class);

//================= Routes For Tags =================
Route::resource('/tags', TagController::class);

//================= Routes For Tags =================
Route::resource('/places', PlaceController::class);

//================= Routes For Tags =================
Route::delete('/delete/image/gallery/{id}', [PlaceController::class,'deleteImage'])->name('image.destroy');

