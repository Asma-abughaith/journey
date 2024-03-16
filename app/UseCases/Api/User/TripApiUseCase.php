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

    public function tags()
    {
        return $this->tripApiRepository->tags();
    }

    public function createTrip($request)
    {
        return $this->tripApiRepository->createTrip($request);
    }
}
