<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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


        return [
            'id' => $this->id,
            'name' => $this->name,
            'subcategories' => SubCategoryResource::collection($this->whenLoaded('subcategories')),
            'places' => PlaceResource::collection(
                $this->places()
                    ->selectRaw('*, ( 6371 * acos( cos( radians(?) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(?) ) + sin( radians(?) ) * sin( radians( latitude ) ) ) ) AS distance', [$userLat, $userLng, $userLat])
                    ->orderBy('distance')
                    ->get()
            ),
        ];
    }
}
