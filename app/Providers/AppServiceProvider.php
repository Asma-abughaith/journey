<?php

namespace App\Providers;

use App\Interfaces\Gateways\Api\User\PlaceApiRepositoryInterface;
use App\Interfaces\Gateways\Web\Admin\AdminRepositoryInterface;
use App\Interfaces\Gateways\Web\Admin\CategoryRepositoryInterface;
use App\Interfaces\Gateways\Web\Admin\FeatureRepositoryInterface;
use App\Interfaces\Gateways\Web\Admin\PermissionRepositoryInterface;
use App\Interfaces\Gateways\Web\Admin\PlaceRepositoryInterface;
use App\Interfaces\Gateways\Web\Admin\RegionRepositoryInterface;
use App\Interfaces\Gateways\Web\Admin\RoleRepositoryInterface;
use App\Interfaces\Gateways\Web\Admin\TagRepositoryInterface;
use App\Interfaces\Gateways\Web\Setting\LanguageRepositoryInterface;
use App\Repositories\Api\User\EloquentPlaceApiRepository;
use App\Repositories\Web\Admin\EloquentAdminRepository;
use App\Repositories\Web\Admin\EloquentCategoryRepository;
use App\Repositories\Web\Admin\EloquentFeatureRepository;
use App\Repositories\Web\Admin\EloquentPermissionRepository;
use App\Repositories\Web\Admin\EloquentPlaceRepository;
use App\Repositories\Web\Admin\EloquentRegionRepository;
use App\Repositories\Web\Admin\EloquentRoleRepository;
use App\Repositories\Web\Admin\EloquentTagRepository;
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
        $this->app->bind(FeatureRepositoryInterface::class, EloquentFeatureRepository::class);
        $this->app->bind(TagRepositoryInterface::class, EloquentTagRepository::class);
        $this->app->bind(PlaceRepositoryInterface::class, EloquentPlaceRepository::class);
        $this->app->bind(PlaceApiRepositoryInterface::class, EloquentPlaceApiRepository::class);


    }

    /**=
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
