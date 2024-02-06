<?php


namespace App\Providers\RoutesProvider\Providers\Routes;


use App\Providers\RoutesProvider\Providers\IRoutesProvider;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\LaravelLocalization;
class Web implements IRoutesProvider
{

//            "prefix" =>  app(LaravelLocalization::class)->setLocale(),

    public function mapping($namespace = "App\Http\Controllers\Web")
    {
        $lang = app(LaravelLocalization::class)->setLocale();

        $middleware = ['web', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath'];

        Route::middleware($middleware)->namespace($namespace)->prefix($lang)->group(function (){
            Route::prefix('admin')->name('admin.')->group(function () {
                // Admin Group
                Route::middleware("guest:admin")->namespace("Admin")->group(function() {
                        Route::group([],base_path('routes/web/admin/without_authentication.php'));
                    });

                Route::middleware("admin")->namespace("Admin")->group(function(){
                        Route::group([],base_path('routes/web/admin/with_authentication.php'));
                    });
            });

        });
    }







}
