<?php

namespace App\Repositories\Api\User;


use App\Http\Resources\SinglePlaceResource;
use App\Http\Resources\SingleSubCategoryResource;
use App\Interfaces\Gateways\Api\User\SubCategoryApiRepositoryInterface;
use App\Models\SubCategory;


class EloquentSubCategoryApiRepository implements SubCategoryApiRepositoryInterface
{



    public function singleSubCategory($id)
    {
        $subCategory = SubCategory::where('id', $id)->with('places')->first();
        return new SingleSubCategoryResource($subCategory);
    }


}
