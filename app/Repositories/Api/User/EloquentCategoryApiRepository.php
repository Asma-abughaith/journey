<?php

namespace App\Repositories\Api\User;

use App\Http\Resources\AllCategoriesResource;
use App\Http\Resources\CategoryResource;
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

    public function allPlacesByCategory($id)
    {
        $category = Category::where('id', $id)->with(['subcategories' => function ($query) {
            $query->orderBy('priority');
        }, 'subcategories'])->first();
        return new CategoryResource($category);

    }


}
