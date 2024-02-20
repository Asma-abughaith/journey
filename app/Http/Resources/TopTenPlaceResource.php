<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TopTenPlaceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    public function toArray($request)
    {
        $userLat = $request->lat ? $request->lat : null;
        $userLng = $request->lng ? $request->lng : null;

        return $this->map(function ($place) use ($userLat, $userLng) {
            $placeLat = $place->latitude;
            $placeLng = $place->longitude;

            $distance = $userLat && $userLng ? $this->haversineDistance($userLat, $userLng, $placeLat, $placeLng) : null;

            return [
//                'id' => $place->id,

                'place_id' => $place->place->id,
                'name' => $place->place->name,
                'description'=>$place->place->description,
                'image' => $place->place->getFirstMediaUrl('main_place', 'main_place_app'),
                'region' => $place->place->region->name,
                'address' => $place->place->address,
                'rating' => $place->place->rating,
                'rank' => $place->rank,
                'distance' => $distance,
            ];
        });
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
