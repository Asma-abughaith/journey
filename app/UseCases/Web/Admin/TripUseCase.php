<?php

namespace App\UseCases\Web\Admin;

use App\Interfaces\Gateways\Web\Admin\TripRepositoryInterface;

class TripUseCase
{
    protected $tripRepository;

    public function __construct(TripRepositoryInterface $tripRepository)
    {
        $this->tripRepository = $tripRepository;
    }

    public function getAllTrips()
    {
        return $this->tripRepository->getAllTrips();
    }

    public function getTrip($id)
    {
        return $this->tripRepository->getTrip($id);
    }

    public function deleteTrip($id)
    {
        return $this->tripRepository->deleteTrip($id);
    }


}
