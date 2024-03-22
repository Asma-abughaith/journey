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
    public function favorite($id);
    public function deleteFavorite($id);
    public function addReview($data);
    public function updateReview($data);
    public function deleteReview($id);
}
