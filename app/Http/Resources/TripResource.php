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
            'image' => $this->place->getFirstMediaUrl('main_place', 'main_place_app'),
            'date' => Carbon::parse($this->date_time)->format('Y-m-d'),
            'name' => $this->name,
            'place_name' => $this->place->name,
            'price' => $this->cost,
            'attendance_number' => $this->attendance_number,
            'location' => $this->place->region->name . ' ' . $this->place->address,
            'attendance_number' => $this->attendance_number,
            'users_number' => $users,
        ];
    }
}
