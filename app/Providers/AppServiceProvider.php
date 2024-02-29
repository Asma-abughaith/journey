<?php

namespace App\Providers;

use App\Http\Controllers\Api\User\TopTenPlaceApiController;
use App\Interfaces\Gateways\Api\User\EventApiRepositoryInterface;
use App\Interfaces\Gateways\Api\User\PlaceApiRepositoryInterface;
use App\Interfaces\Gateways\Api\User\PopularPlaceApiRepositoryInterface;
use App\Interfaces\Gateways\Api\User\SubCategoryApiRepositoryInterface;
use App\Interfaces\Gateways\Api\User\TopTenPlaceApiRepositoryInterface;
use App\Interfaces\Gateways\Api\User\VolunteeringApiRepositoryInterface;
use App\Interfaces\Gateways\Web\Admin\AdminRepositoryInterface;
use App\Interfaces\Gateways\Web\Admin\CategoryRepositoryInterface;
use App\Interfaces\Gateways\Web\Admin\EventRepositoryInterface;
use App\Interfaces\Gateways\Web\Admin\FeatureRepositoryInterface;
use App\Interfaces\Gateways\Web\Admin\OrganizerRepositoryInterface;
use App\Interfaces\Gateways\Web\Admin\PermissionRepositoryInterface;
use App\Interfaces\Gateways\Web\Admin\PlaceRepositoryInterface;
use App\Interfaces\Gateways\Web\Admin\PlanRepositoryInterface;
use App\Interfaces\Gateways\Web\Admin\PopularPlaceRepositoryInterface;
use App\Interfaces\Gateways\Web\Admin\RegionRepositoryInterface;
use App\Interfaces\Gateways\Web\Admin\RoleRepositoryInterface;
use App\Interfaces\Gateways\Web\Admin\TagRepositoryInterface;
use App\Interfaces\Gateways\Web\Admin\TopTenPlaceRepositoryInterface;
use App\Interfaces\Gateways\Web\Admin\VolunteeringRepositoryInterface;
use App\Interfaces\Gateways\Web\Setting\LanguageRepositoryInterface;
use App\Repositories\Api\User\EloquentEventApiRepository;
use App\Repositories\Api\User\EloquentPlaceApiRepository;
use App\Repositories\Api\User\EloquentPopularPlaceApiRepository;
use App\Repositories\Api\User\EloquentSubCategoryApiRepository;
use App\Repositories\Api\User\EloquentTopTenPlaceApiRepository;
use App\Repositories\Api\User\EloquentVolunteeringApiRepository;
use App\Repositories\Web\Admin\EloquentAdminRepository;
use App\Repositories\Web\Admin\EloquentCategoryRepository;
use App\Repositories\Web\Admin\EloquentEventRepository;
use App\Repositories\Web\Admin\EloquentFeatureRepository;
use App\Repositories\Web\Admin\EloquentOrganizerRepository;
use App\Repositories\Web\Admin\EloquentPermissionRepository;
use App\Repositories\Web\Admin\EloquentPlaceRepository;
use App\Repositories\Web\Admin\EloquentPlanRepository;
use App\Repositories\Web\Admin\EloquentPopularPlaceRepository;
use App\Repositories\Web\Admin\EloquentRegionRepository;
use App\Repositories\Web\Admin\EloquentRoleRepository;
use App\Repositories\Web\Admin\EloquentTagRepository;
use App\Repositories\Web\Admin\EloquentTopTenPlaceRepository;
use App\Repositories\Web\Admin\EloquentVolunteeringRepository;
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
        $this->app->bind(SubCategoryApiRepositoryInterface::class, EloquentSubCategoryApiRepository::class);

        $this->app->bind(TopTenPlaceApiRepositoryInterface::class, EloquentTopTenPlaceApiRepository::class);
        $this->app->bind(PopularPlaceApiRepositoryInterface::class, EloquentPopularPlaceApiRepository::class);
        $this->app->bind(TopTenPlaceRepositoryInterface::class, EloquentTopTenPlaceRepository::class);
        $this->app->bind(PopularPlaceRepositoryInterface::class, EloquentPopularPlaceRepository::class);
        $this->app->bind(OrganizerRepositoryInterface::class, EloquentOrganizerRepository::class);

        $this->app->bind(EventRepositoryInterface::class, EloquentEventRepository::class);
        $this->app->bind(EventApiRepositoryInterface::class, EloquentEventApiRepository::class);

        $this->app->bind(VolunteeringRepositoryInterface::class, EloquentVolunteeringRepository::class);
        $this->app->bind(VolunteeringApiRepositoryInterface::class, EloquentVolunteeringApiRepository::class);

        $this->app->bind(PlanRepositoryInterface::class, EloquentPlanRepository::class);

    }

    /**=
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
