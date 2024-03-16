<?php

namespace App\Interfaces\Gateways\Api\User;


interface TripApiRepositoryInterface
{
    public function tags();

    public function createTrip($data);
}
