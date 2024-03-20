<?php

namespace App\Interfaces\Gateways\Api\User;


interface TripApiRepositoryInterface
{
    public function trips();

    public function privateTrips();

    public function tripDetails($trip_id);

    public function tags();

    public function createTrip($data);

    public function joinTrip($trip_id);

    public function cancelJoinTrip($trip_id);

    public function changeStatus($data);
}
