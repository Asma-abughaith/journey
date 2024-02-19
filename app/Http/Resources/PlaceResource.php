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
        $userLat = $request->lat?$request->lat:null;
        $userLng = $request->lng?$request->lng:null;


        $placeLat = $this->latitude;
        $placeLng = $this->longitude;

        $distance = $userLat && $userLng?$this->haversineDistance($userLat, $userLng, $placeLat, $placeLng):null;
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->getFirstMediaUrl('main_place', 'main_place_app'),
            'region' => $this->region->name,
            'address' => $this->address,
            'rating'=>$this->rating,
            'distance' => $distance,
        ];
    }

    private function haversineDistance($userLat, $userLng, $placeLat, $placeLng)
    {
        $earthRadius = 6371;

        $latDifference = deg2rad($placeLat - $userLat);
        $lngDifference = deg2rad($placeLng - $userLng);

        $a = sin($latDifference / 2) * sin($latDifference / 2) +
            cos(deg2rad($userLat)) * cos(deg2rad($placeLat)) *
            sin($lngDifference / 2) * sin($lngDifference / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $distance = $earthRadius * $c;

        return $distance;
    }
}
