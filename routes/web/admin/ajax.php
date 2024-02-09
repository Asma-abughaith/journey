<?php

use App\Http\Controllers\Web\Admin\Ajax\AjaxRoleController;
use Illuminate\Support\Facades\Route;


Route::prefix('role')->group(function () {
    Route::get('/get_role_based/{guard_name}', [AjaxRoleController::class, 'index']);
});
