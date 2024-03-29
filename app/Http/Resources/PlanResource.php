<?php

namespace App\Http\Resources;

use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // $placeIds = $this->activities->pluck('place_id')->unique();
        // $randomPlaceId = $placeIds->random();
        $placeId = $this->activities->pluck('place_id')->first();
        $place = Place::find($placeId);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'number_of_days' => $this->activities->groupBy('day_number')->count(),
            'number_of_activities' => $this->activities->count(),
            'number_of_place' => $this->activities->groupBy('place_id')->count(),
            'image' => $place->getFirstMediaUrl('main_place', 'main_place_app'),
        ];
    }
}
