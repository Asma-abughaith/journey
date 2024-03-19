<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TripDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $images = [];
        foreach ($this->place->getMedia('place_gallery') as $image) {
            $images[] = $image->original_url;
        }

        $tags = $this->tags->map(function ($tag) {
            return [
                'name' => $tag->name,
                'icon' => $tag->icon,
            ];
        });

        return [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->place->address,
            'place_gallery' => $images,
            'description' => $this->description,
            'tags' => $tags,
            'place_name' => $this->place->name,
            'cost' => $this->cost,
            'age_min' => json_decode($this->age_range)->min,
            'age_max' => json_decode($this->age_range)->max,
            'gender' => $this->gender(),
            'date' => Carbon::parse($this->date_time)->format('Y-m-d'),
            'time' => Carbon::parse($this->date_time)->format('H:i:s'),
        ];
    }
}
