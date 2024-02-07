<?php

namespace App\Providers;

use App\Interfaces\Gateways\Web\Admin\PermissionRepositoryInterface;
use App\Repositories\Web\Admin\EloquentPermissionRepository;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Mcamara\LaravelLocalization\LaravelLocalization;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->bind(PermissionRepositoryInterface::class, EloquentPermissionRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Route::bind('lang', function ($value) {
            return app(LaravelLocalization::class)->setLocale($value);
        });
    }
}
