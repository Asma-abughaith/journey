<?php

namespace App\Http\Resources;

use App\Models\Trip;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TripResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $trip = Trip::findOrFail($this->id);
        $trip->load('usersTrip.user');
        $users = UserResource::collection($trip->usersTrip->pluck('user'));


        return [
            'id' => $this->id,
            'place' => $this->place->name,
            'name' => $this->name,
            'cost' => $this->cost,
            'attendance_number' => $this->attendance_number,
            'trip_image' => $this->place->getFirstMediaUrl('main_place', 'main_place_app'),
            'users_number' =>$users,
        ];
    }
}