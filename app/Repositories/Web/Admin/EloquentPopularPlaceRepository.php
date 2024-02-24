<?php

namespace App\Repositories\Web\Admin;

use App\Entities\Web\Admin\PopularPlaceEntity;
use App\Interfaces\Gateways\Web\Admin\PopularPlaceRepositoryInterface;
use App\Models\PopularPlace;


class EloquentPopularPlaceRepository implements PopularPlaceRepositoryInterface
{
    public function allPopularPlaces()
    {
        $eloquentTopTenPlaces = PopularPlace::with('place')->get();
        $topTenPlaces = [];

        foreach ($eloquentTopTenPlaces as $eloquentTopTenPlace) {
            $topTenPlaces[] = $this->convertToEntity($eloquentTopTenPlace);
        }

        return $topTenPlaces;
    }

    public function getPopularPlace($popularPlace)
    {
        return $this->convertToEntity($popularPlace);
    }

    public function getPopularPlaceById($popularId)
    {
        $eloquentPopularPlace = PopularPlace::find($popularId);

        return $eloquentPopularPlace ? $this->convertToEntity($eloquentPopularPlace) : null;
    }

    public function createPopularPlace( $popularPlaceDate)
    {
        $eloquentPopularPlace = PopularPlace::create($popularPlaceDate);

        return $this->convertToEntity($eloquentPopularPlace);
    }

    public function  updatePopularPlace($popularPlace, $popularPlaceDate)
    {

        $popularPlace->update($popularPlaceDate);

        return $this->convertToEntity($popularPlace);
    }


    public function deletePopularPlace($popularPlace)
    {
        if ($popularPlace) {
            $popularPlace->delete();
        }
        return;
    }

    protected function convertToEntity(PopularPlace $eloquentPopularPlace)
    {
        $popularPlace = new PopularPlaceEntity();
        $popularPlace->setId($eloquentPopularPlace->id);
        $popularPlace->setPrice($eloquentPopularPlace->price);
        $popularPlace->setPlace($eloquentPopularPlace->place->name);
        return $popularPlace;
    }
}
