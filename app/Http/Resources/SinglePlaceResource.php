<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SinglePlaceResource extends JsonResource
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
        $placeLat = $this->latitude;
        $placeLng = $this->longitude;

        $tags = $this->tags->map(function ($tag) {
            return [
                'name' => $tag->name,
                'icon' => $tag->icon,
            ];
        });

        $features = $this->features->map(function ($feature) {
            return [
                'name' => $feature->name,
                'icon' => $feature->icon,
            ];
        });

        $openingHours = $this->openingHours->map(function ($openingHours) {
            return [
                'day_of_week' => daysTranslation(request()->lang, $openingHours->day_of_week),
                'opening_time' => $openingHours->opening_time,
                'closing_time' => $openingHours->closing_time,
            ];
        });

        $gallery = [];
        foreach ($this->getMedia('place_gallery') as $image) {
            $gallery[] = $image->original_url;
        }

        $distance = $userLat && $userLng ? haversineDistance($userLat, $userLng, $placeLat, $placeLng) : null;
        return [
            'id' => $this->id,
            'name' => $this->name,
            'category' => $this->category->name,
            'subcategory' => $this->subcategory->name,
            'description' => $this->description,
            'image' => $this->getFirstMediaUrl('main_place', 'main_place_app'),
            'region' => $this->region->name,
            'address' => $this->address,
            'rating' => $this->rating,
            'total_user_rating' => $this->total_user_rating,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'business_status' => businessStatusTranslation(request()->lang, $this->business_status),
            'google_map_url' => $this->google_map_url,
            'phone_number' => $this->phone_number,
            'price_level' => $this->price_level,
            'website' => $this->website,
            'distance' => $distance,
            'opening_hours' => $openingHours,
            'features' => $features,
            'tags' => $tags,
            'gallery' => $gallery,
        ];
    }
}
