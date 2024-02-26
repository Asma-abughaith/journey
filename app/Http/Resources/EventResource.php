<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $startDatetime = dateTime( $this->start_datetime);
        $endDateTime =  dateTime($this->end_datetime);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'start_day'=> $startDatetime->format('Y-m-d'),
            'start_time'=>$startDatetime->format('H:i:s'),
            'end_day'=> $endDateTime->format('Y-m-d'),
            'end_time'=>$endDateTime->format('H:i:s'),
            'image' => $this->getFirstMediaUrl('event', 'event_app'),
            'region' => $this->region->name,
            'address' => $this->address,
            'price'=>$this->price,
            'status' => intval($this->status)
        ];
    }
}
