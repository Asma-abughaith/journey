<?php


namespace App\Providers\RoutesProvider\Providers\Routes;


use App\Providers\RoutesProvider\Providers\IRoutesProvider;
use Illuminate\Support\Facades\Route;


class Web implements IRoutesProvider
{
    public function mapping($namespace = "App\Http\Controllers\Web")
    {


        $middleware = ['web'];

        Route::middleware($middleware)->group(function () {
            Route::prefix('admin')->name('admin.')->group(function () {
                // Admin Group
                Route::middleware("guest:admin")->group(function () {
                    Route::group([], base_path('routes/web/admin/without_authentication.php'));
                });

                Route::middleware("admin")->group(function () {
                    Route::group([], base_path('routes/web/admin/with_authentication.php'));
                });

                Route::prefix("ajax")->name("ajax.")->group(function () {
                    Route::group([], base_path('routes/web/admin/ajax.php'));
                });
            });
        });
    }
}
