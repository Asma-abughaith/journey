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
        Route::group([
            "middleware" => ['web', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
            "namespace" => $namespace,
            "prefix" =>  app(LaravelLocalization::class)->setLocale(),
        ], function () {
            // Admin Group
            Route::middleware("guest:admin")->name("admin.")->prefix("admin")
                ->namespace("Admin")->group(function() {
                    Route::group([],base_path('routes/web/admin/without_authentication.php'));
                });


              Route::middleware("admin")->name("admin.")->prefix("admin")
                  ->namespace("Admin")->group(function(){
                      Route::group([],base_path('routes/web/admin/with_authentication.php'));
                  });
        });
    }







}
