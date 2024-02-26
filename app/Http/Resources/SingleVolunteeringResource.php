<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SingleVolunteeringResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $organizers = $this->organizers->map(function ($organizer) {
            return [
                'name' => $organizer->name,
                'image' => $organizer->getFirstMediaUrl('organizer', 'organizer_app'),
            ];
        });

        $startDatetime = dateTime( $this->start_datetime);
        $endDateTime =  dateTime($this->end_datetime);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description'=>$this->description,
            'image' => $this->getFirstMediaUrl('volunteering', 'volunteering_app'),
            'start_day'=> $startDatetime->format('Y-m-d'),
            'start_time'=>$startDatetime->format('H:i:s'),
            'end_day'=> $endDateTime->format('Y-m-d'),
            'end_time'=>$endDateTime->format('H:i:s'),
            'region' => $this->region->name,
            'address' => $this->address,
            'status' => intval($this->status),
            'link'=>$this->link,
            'hours_worked'=>$this->hours_worked,
            'organizers'=>$organizers,


        ];
    }
}
