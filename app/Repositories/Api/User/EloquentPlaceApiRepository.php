<?php

namespace App\Repositories\Api\User;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\SinglePlaceResource;
use App\Interfaces\Gateways\Api\User\PlaceApiRepositoryInterface;
use App\Models\Category;
use App\Models\Place;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class EloquentPlaceApiRepository implements PlaceApiRepositoryInterface
{

    public function singlePlace($id)
    {
        $place = Place::where('id', $id)->first();
        return new SinglePlaceResource($place);
    }

    public function createFavoritePlace($data)
    {
        $user= User::find($data['user_id']);
        $user->favoritePlaces()->attach([$data['place_id']]);
    }

    public function deleteFavoritePlace($id){
        $user= Auth::guard('api')->user();
        $user->favoritePlaces()->detach($id);
    }
}
