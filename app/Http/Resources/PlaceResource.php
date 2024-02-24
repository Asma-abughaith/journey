<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlaceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->getFirstMediaUrl('main_place', 'main_place_app'),
            'region' => $this->region->name,
            'address' => $this->address,
            'rating'=>$this->rating,
            'distance' => $this->distance,
        ];
    }


}
