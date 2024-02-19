<?php

namespace App\UseCases\Api\User;

use App\Interfaces\Gateways\Api\User\PlaceApiRepositoryInterface;

class PlaceApiUseCase
{
    protected $placeApiRepository;

    public function __construct(PlaceApiRepositoryInterface $placeApiRepository)
    {
        $this->placeApiRepository = $placeApiRepository;
    }

    public function allPlacesByCategory($id)
    {
        return $this->placeApiRepository->allPlacesByCategory($id);
    }


}
