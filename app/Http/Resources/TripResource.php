<?php

namespace App\Http\Resources;

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
        return [
            'id' => $this->id,
            'place' => $this->place->name,
            'name' => $this->name,
            'description' => $this->description,
            'cost' => $this->cost,
            'age_min' => json_decode($this->age_range)->min,
            'age_max' => json_decode($this->age_range)->max,
            'sex' => $this->gender(),
            'date' => Carbon::parse($this->date_time)->format('Y-m-d'),
            'time' => Carbon::parse($this->date_time)->format('H:i:s'),
            'attendance_number' => $this->attendance_number,
            'users_number' => [],
        ];
    }
}
