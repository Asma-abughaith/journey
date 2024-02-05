<?php


namespace App\Providers\RoutesProvider\Providers\Routes;


use App\Providers\RoutesProvider\Providers\IRoutesProvider;
use Illuminate\Support\Facades\Route;

class Api implements IRoutesProvider
{


    public function mapping($namespace = "App\Http\Controllers\Api")
    {
//        when you reach to api you should edit this file



//        Route::group(["prefix" => "api/{lang}/", "middleware" => ["api","lang"] , "namespace" => $namespace, "name" => "api."],function() use ($namespace){
//            Route::namespace("Auth")->group(base_path('routes/api/without_authentication.php'));
//
//            //Group Has Auth
//            Route::middleware("auth:api")->group(function (){
//                Route::group([],base_path('routes/api/main/with_authentication.php'));
//                Route::group([],base_path('routes/api/client/with_authentication.php'));
//            });
//
//            //technician app
//            Route::prefix("technician")->namespace("Technician")->group(function (){
//                Route::group([],base_path('routes/api/technician/without_authentication.php'));
//                Route::middleware(["auth:api", "is-technician", "technician.is_completed"])->group(base_path('routes/api/technician/with_authentication.php'));
//            });
//
//            Route::group([],base_path('routes/api/main/without_authentication.php'));
//            Route::group([],base_path('routes/api/client/without_authentication.php'));
//        });



    }
}
