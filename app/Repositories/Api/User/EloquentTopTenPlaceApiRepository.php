<?php

namespace App\Repositories\Api\User;

use App\Http\Resources\TopTenPlaceResource;
use App\Interfaces\Gateways\Api\User\TopTenPlaceApiRepositoryInterface;
use App\Models\TopTen;


class EloquentTopTenPlaceApiRepository implements TopTenPlaceApiRepositoryInterface
{



    public function topTenPlaces()
    {
        $topTenPlaces = TopTen::with('place')->orderBy('rank')->get();

        return new TopTenPlaceResource($topTenPlaces);
    }


}
