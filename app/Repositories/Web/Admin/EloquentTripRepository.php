<?php

namespace App\Repositories\Web\Admin;

use App\Entities\Web\Admin\TripEntity;
use App\Interfaces\Gateways\Web\Admin\TripRepositoryInterface;
use App\Models\Trip;
use App\Models\User;

class EloquentTripRepository implements TripRepositoryInterface
{

    public function getAllTrips()
    {
        $eloquentTrips = Trip::with('usersTrip.user')->get();
        $trips = [];

        foreach ($eloquentTrips as $eloquentTrip) {
            $trips[] = $this->convertToEntity($eloquentTrip);
        }

        return $trips;
    }

    public function getTrip($id)
    {
        $eloquentTrip = Trip::where('id', $id)->with('usersTrip.user')->first();
        $trip = $this->convertToEntity($eloquentTrip);
        return $trip;
    }

    public function deleteTrip($id)
    {
        $eloquentTrip = Trip::find($id);

        if ($eloquentTrip) {
            $eloquentTrip->update([
                'status' => '3'
            ]);

            foreach ($eloquentTrip->usersTrip as $userTrip) {
                $userTrip->update([
                    'status' => '4'
                ]);
            }
        }
    }



    protected function convertToEntity(Trip $eloquentTrip)
    {
        $users_trip = [];
        foreach ($eloquentTrip->usersTrip as $user_trip) {
            $users_trip[] = $user_trip->user->username;
        }

        $trip = new TripEntity();
        $trip->setId($eloquentTrip->id);
        $trip->setName($eloquentTrip->name);
        $trip->setDescription($eloquentTrip->description);
        $trip->setSex($eloquentTrip->sex);
        $trip->setCost($eloquentTrip->cost);
        $trip->setMinAge(json_decode($eloquentTrip->age_range)->min);
        $trip->setMaxAge(json_decode($eloquentTrip->age_range)->max);
        $trip->setAttendanceNumber($eloquentTrip->attendance_number);
        $trip->setDatetime($eloquentTrip->date_time);
        $trip->setStatus($eloquentTrip->status);
        $trip->setPlace($eloquentTrip->place->name);
        $trip->setCreator($eloquentTrip->user->username);
        $trip->setUsersTrip($users_trip);

        return $trip;
    }
}
