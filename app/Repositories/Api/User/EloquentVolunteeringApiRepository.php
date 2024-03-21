<?php

namespace App\Repositories\Api\User;

use App\Http\Resources\AllCategoriesResource;
use App\Http\Resources\EventResource;
use App\Http\Resources\SingleEventResource;
use App\Http\Resources\SingleVolunteeringResource;
use App\Http\Resources\VolunteeringResource;
use App\Interfaces\Gateways\Api\User\EventApiRepositoryInterface;
use App\Interfaces\Gateways\Api\User\VolunteeringApiRepositoryInterface;
use App\Models\Category;
use App\Models\Event;
use App\Models\User;
use App\Models\Volunteering;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Auth;


class EloquentVolunteeringApiRepository implements VolunteeringApiRepositoryInterface
{
    public function getAllVolunteerings()
    {
        $eloquentVolunteerings = Volunteering::OrderBy('start_datetime')->get();
        return new ResourceCollection(VolunteeringResource::collection($eloquentVolunteerings));
    }

    public function activeVolunteerings()
    {
        $now = now()->setTimezone('Asia/Riyadh');
        $eloquentVolunteerings = Volunteering::orderBy('start_datetime')->where('status', '1')->where('end_datetime', '>=', $now)->get();
        Volunteering::where('status', '1')->whereNotIn('id', $eloquentVolunteerings->pluck('id'))->update(['status' => '0']);
        return new ResourceCollection(VolunteeringResource::collection($eloquentVolunteerings));
    }

    public function volunteering($id)
    {
        $eloquentVolunteerings = Volunteering::where('id', $id)->first();
        return new SingleVolunteeringResource($eloquentVolunteerings);
    }

    public function dateVolunteerings($date)
    {
        $eloquentVolunteerings = Volunteering::whereDate('start_datetime', '<=', $date)->whereDate('end_datetime', '>=', $date)->where('status', '1')->get();
        return new ResourceCollection(VolunteeringResource::collection($eloquentVolunteerings));
    }

    public function createInterestVolunteering($data)
    {
        $user= User::find($data['user_id']);
        $user->volunteeringInterestables()->attach([$data['volunteering_id']]);
    }
    public function disinterestVolunteering($id)
    {
        $user= Auth::guard('api')->user();
        $user->volunteeringInterestables()->detach($id);

    }
    public function favorite($id)
    {
        $user= Auth::guard('api')->user();
        $user->favoriteVolunteering()->attach($id);
    }

    public function deleteFavorite($id){
        $user= Auth::guard('api')->user();
        $user->favoriteVolunteering()->detach($id);
    }
}
