<?php

namespace App\Interfaces\Gateways\Web\Admin;


interface TripRepositoryInterface
{
    public function getAllTrips();
    public function getTrip($id);
    public function deleteTrip($id);


}
