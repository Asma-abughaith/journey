<?php

namespace App\Repositories\Api\User;

use App\Http\Resources\AllCategoriesResource;
use App\Http\Resources\EventResource;
use App\Http\Resources\SingleEventResource;
use App\Interfaces\Gateways\Api\User\EventApiRepositoryInterface;
use App\Models\Category;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Auth;


class EloquentEventApiRepository implements EventApiRepositoryInterface
{
    public function getAllEvents()
    {
        $eloquentEvents = Event::OrderBy('start_datetime')->get();
       return new ResourceCollection(EventResource::collection($eloquentEvents));
    }

    public function activeEvents()
    {
        $now = now()->setTimezone('Asia/Riyadh');
        $eloquentEvents = Event::orderBy('start_datetime')->where('status', '1')->where('end_datetime', '>=', $now)->get();
        Event::where('status','1')->whereNotIn('id', $eloquentEvents->pluck('id'))->update(['status' => '0']);
        return new ResourceCollection(EventResource::collection($eloquentEvents));
    }

    public function event($id)
    {
        $eloquentEvents = Event::where('id',$id)->first();
        return new SingleEventResource($eloquentEvents);
    }

    public function dateEvents($date)
    {
        $eloquentEvents = Event::whereDate('start_datetime', '<=', $date)->whereDate('end_datetime', '>=', $date)->where('status', '1')->get();
        return new ResourceCollection(EventResource::collection($eloquentEvents));
    }

    public function createInterestEvent($data)
    {
        $user= User::find($data['user_id']);
        $user->eventInterestables()->attach([$data['event_id']]);
    }

    public function disinterestEvent($id)
    {
        $user= Auth::guard('api')->user();
        $user->eventInterestables()->detach($id);

    }

    public function favorite($id)
    {
        $user= Auth::guard('api')->user();
        $user->favoriteEvent()->attach($id);
    }

    public function deleteFavorite($id){
        $user= Auth::guard('api')->user();
        $user->favoriteEvent()->detach($id);
    }


}
