<?php

namespace App\Interfaces\Presenters\Web\Admin;


use App\Entities\Web\Admin\PlaceEntity;
use App\Entities\Web\Admin\PlanEntity;
use App\Entities\Web\Admin\TripEntity;

class TripPresenter
{
    public function presentAllTrip($trips)
    {
        $formattedTrips = [];

        foreach ($trips as $trip) {
            $formattedTrips[] = $this->formatTrip($trip);
        }
        return $formattedTrips;
    }

    public function presentTrip($trip)
    {
        return $this->formatTrip($trip);
    }


    protected function formatTrip(TripEntity $trip)
    {
        return [
            'id' => $trip->getId(),
            'name' => $trip->getName(),
            'description' => $trip->getDescription(),
            'cost'=>$trip->getCost(),
            'place'=>$trip->getPlace(),
            'min_age'=>$trip->getMinAge(),
            'max_age'=>$trip->getMaxAge(),
            'sex'=>$trip->getSex(),
            'datetime'=>$trip->getDatetime(),
            'attendance_number'=>$trip->getAttendanceNumber(),
            'status'=>$trip->getStatus(),
            'users_trip'=>$trip->getUsersTrip(),
            'creator' => $trip->getCreator(),

        ];
    }
}
