<?php

namespace App\UseCases\Web\Admin;

use App\Interfaces\Gateways\Web\Admin\PopularPlaceRepositoryInterface;

class PopularPlaceUseCase
{
    protected $poluarPlacesRepository;

    public function __construct(PopularPlaceRepositoryInterface $popularPlacesRepository)
    {
        $this->poluarPlacesRepository = $popularPlacesRepository;
    }

    public function allPopularPlaces()
    {
        return $this->poluarPlacesRepository->allPopularPlaces();
    }

    public function getPopularPlace($popularPlace)
    {
        return $this->poluarPlacesRepository->getPopularPlace($popularPlace);
    }

    public function getPopularPlaceById($popularPlaceId)
    {
        return $this->poluarPlacesRepository->getPopularPlaceById($popularPlaceId);
    }

    public function createPopularPlace($request)
    {
        return $this->poluarPlacesRepository->createPopularPlace(
            [
                'place_id' =>  $request['place_id'],
                'price'=>$request['price']
            ],

        );
    }

    public function updatePopularPlace($popularPlace, $request)
    {
        return $this->poluarPlacesRepository->updatePopularPlace(
            $popularPlace,
            [
                'place_id' =>  $request['place_id'],
                'price'=>$request['price']
            ],
        );
    }

    public function deletePopularPlace($popularPlace)
    {
        return $this->poluarPlacesRepository->deletePopularPlace($popularPlace);
    }
}
