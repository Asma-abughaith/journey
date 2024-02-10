<?php

namespace App\Providers;

use App\Interfaces\Gateways\Web\Admin\AdminRepositoryInterface;
use App\Interfaces\Gateways\Web\Admin\CategoryRepositoryInterface;
use App\Interfaces\Gateways\Web\Admin\PermissionRepositoryInterface;
use App\Interfaces\Gateways\Web\Admin\RoleRepositoryInterface;
use App\Repositories\Web\Admin\EloquentAdminRepository;
use App\Repositories\Web\Admin\EloquentCategoryRepository;
use App\Repositories\Web\Admin\EloquentPermissionRepository;
use App\Repositories\Web\Admin\EloquentRoleRepository;
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
        $this->app->bind(RoleRepositoryInterface::class, EloquentRoleRepository::class);
        $this->app->bind(AdminRepositoryInterface::class, EloquentAdminRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, EloquentCategoryRepository::class);
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
