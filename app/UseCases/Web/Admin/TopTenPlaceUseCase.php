<?php

namespace App\UseCases\Web\Admin;

use App\Interfaces\Gateways\Web\Admin\TopTenPlaceRepositoryInterface;

class TopTenPlaceUseCase
{
    protected $topTenPlacesRepository;

    public function __construct(TopTenPlaceRepositoryInterface $topTenPlacesRepository)
    {
        $this->topTenPlacesRepository = $topTenPlacesRepository;
    }

    public function allTopTenPlaces()
    {
        return $this->topTenPlacesRepository->allTopTenPlaces();
    }

    public function getTopTenPlace($topTenPlace)
    {
        return $this->topTenPlacesRepository->getTopTenPlace($topTenPlace);
    }

    public function getTopTenPlaceById($topTenPlaceId)
    {
        return $this->topTenPlacesRepository->getTopTenPlaceById($topTenPlaceId);
    }

    public function createTopTenPlace($request)
    {
        return $this->topTenPlacesRepository->createTopTenPlace(
            [
                'place_id' =>  $request['place_id'],
                'rank'=>$request['rank']
            ],

        );
    }

    public function updateTopTenPlace($id, $request)
    {
        return $this->topTenPlacesRepository->updateTopTenPlace(
            $id,
            [
                'place_id' =>  $request['place_id'],
                'rank'=>$request['rank']
            ],
        );
    }

    public function deleteTopTenPlace($topTenPlace)
    {
        return $this->topTenPlacesRepository->deleteTopTenPlace($topTenPlace);
    }
}
