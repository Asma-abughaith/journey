<?php

namespace App\Repositories\Api\User;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\SinglePlaceResource;
use App\Interfaces\Gateways\Api\User\PlaceApiRepositoryInterface;
use App\Models\Category;
use App\Models\Place;


class EloquentPlaceApiRepository implements PlaceApiRepositoryInterface
{

    public function singlePlace($id)
    {
        $place = Place::where('id', $id)->first();
        return new SinglePlaceResource($place);
    }


}
