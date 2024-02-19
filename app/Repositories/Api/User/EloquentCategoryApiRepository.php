<?php

namespace App\Repositories\Api\User;

use App\Http\Resources\AllCategoriesResource;
use App\Interfaces\Gateways\Api\User\CategoryApiRepositoryInterface;
use App\Models\Category;
use Illuminate\Http\Resources\Json\ResourceCollection;


class EloquentCategoryApiRepository implements CategoryApiRepositoryInterface
{
    public function getAllCategories()
    {
        $eloquentCategories = Category::orderBy('priority')->get();
        return new ResourceCollection(AllCategoriesResource::collection($eloquentCategories));
    }


}
