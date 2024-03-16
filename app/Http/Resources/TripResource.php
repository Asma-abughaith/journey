<?php

namespace App\Http\Resources;

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
        return [
            'id' => $this->id,
            'place' => $this->place->name,
            'name' => $this->name,
            'description' => $this->description,
            'cost' => $this->cost,
            'age_min' => json_decode($this->age_range)->min,
            'age_max' => json_decode($this->age_range)->max,
            'sex' => $this->gender(),
            'date' => $this->date_time->format('Y-m-d'),
            'time' => $this->date_time->format('H:i:s'),
            'attendance_number' => $this->attendance_number,
        ];
    }
}
