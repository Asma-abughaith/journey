<?php

namespace App\Repositories\Api\User;

use App\Http\Resources\AllCategoriesResource;
use App\Http\Resources\EventResource;
use App\Http\Resources\SingleEventResource;
use App\Http\Resources\SingleVolunteeringResource;
use App\Http\Resources\VolunteeringResource;
use App\Interfaces\Gateways\Api\User\EventApiRepositoryInterface;
use App\Interfaces\Gateways\Api\User\PlanApiRepositoryInterface;
use App\Interfaces\Gateways\Api\User\VolunteeringApiRepositoryInterface;
use App\Models\Category;
use App\Models\Event;
use App\Models\User;
use App\Models\Volunteering;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Auth;


class EloquentPlanApiRepository implements PlanApiRepositoryInterface
{

}
