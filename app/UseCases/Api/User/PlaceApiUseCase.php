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



    public function singlePlace($id)
    {
        return $this->placeApiRepository->singlePlace($id);
    }


}