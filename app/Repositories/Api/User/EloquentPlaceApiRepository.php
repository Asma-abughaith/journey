<?php

namespace App\Repositories\Api\User;

use App\Http\Resources\CategoryResource;
use App\Interfaces\Gateways\Api\User\PlaceApiRepositoryInterface;
use App\Models\Category;


class EloquentPlaceApiRepository implements PlaceApiRepositoryInterface
{

    public function allPlacesByCategory($id)
    {
        $category = Category::where('id', $id)->with(['subcategories' => function ($query) {
                $query->orderBy('priority');
            }, 'subcategories.places.region'])->first();
//        $category = Category::where('id', $id)->with('subcategories.places.region')->first();
        return new CategoryResource($category);
//        return CategoryResource::collection([$category]);

    }


}
