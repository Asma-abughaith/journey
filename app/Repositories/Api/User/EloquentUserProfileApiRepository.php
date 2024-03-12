<?php

namespace App\Repositories\Api\User;

use App\Http\Resources\AllCategoriesResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\UserProfileResource;
use App\Interfaces\Gateways\Api\User\CategoryApiRepositoryInterface;
use App\Interfaces\Gateways\Api\User\UserProfileApiRepositoryInterface;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Auth;


class EloquentUserProfileApiRepository implements UserProfileApiRepositoryInterface
{
    public function getUserDetails()
    {
        $userId = Auth::guard('api')->user()->id;
        $eloquentUser = User::find($userId);
        return new UserProfileResource($eloquentUser);
    }

}
