<?php

namespace App\UseCases\Api\User;

use App\Interfaces\Gateways\Api\User\TripApiRepositoryInterface;

class TripApiUseCase
{
    protected $tripApiRepository;

    public function __construct(TripApiRepositoryInterface $tripApiRepository)
    {
        $this->tripApiRepository = $tripApiRepository;
    }

    public function trips()
    {
        return $this->tripApiRepository->trips();
    }

    public function tags()
    {
        return $this->tripApiRepository->tags();
    }

    public function createTrip($request)
    {
        return $this->tripApiRepository->createTrip($request);
    }

    public function joinTrip($trip_id)
    {
        return $this->tripApiRepository->joinTrip($trip_id);
    }
}
