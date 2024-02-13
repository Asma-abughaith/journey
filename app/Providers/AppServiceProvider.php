<?php

namespace App\Providers;

use App\Interfaces\Gateways\Web\Admin\AdminRepositoryInterface;
use App\Interfaces\Gateways\Web\Admin\CategoryRepositoryInterface;
use App\Interfaces\Gateways\Web\Admin\PermissionRepositoryInterface;
use App\Interfaces\Gateways\Web\Admin\RegionRepositoryInterface;
use App\Interfaces\Gateways\Web\Admin\RoleRepositoryInterface;
use App\Interfaces\Gateways\Web\Setting\LanguageRepositoryInterface;
use App\Repositories\Web\Admin\EloquentAdminRepository;
use App\Repositories\Web\Admin\EloquentCategoryRepository;
use App\Repositories\Web\Admin\EloquentPermissionRepository;
use App\Repositories\Web\Admin\EloquentRegionRepository;
use App\Repositories\Web\Admin\EloquentRoleRepository;
use App\Repositories\Web\Setting\EloquentLanguageRepository;
use App\Interfaces\Gateways\Api\User\CategoryApiRepositoryInterface;
use App\Interfaces\Gateways\Web\Admin\SubCategoryRepositoryInterface;
use App\Repositories\Api\User\EloquentCategoryApiRepository;
use App\Repositories\Web\Admin\EloquentSubCategoryRepository;
use Illuminate\Support\ServiceProvider;

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
        $this->app->bind(LanguageRepositoryInterface::class, EloquentLanguageRepository::class);
        $this->app->bind(CategoryApiRepositoryInterface::class, EloquentCategoryApiRepository::class);
        $this->app->bind(SubCategoryRepositoryInterface::class, EloquentSubCategoryRepository::class);
        $this->app->bind(RegionRepositoryInterface::class, EloquentRegionRepository::class);

    }

    /**=
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
