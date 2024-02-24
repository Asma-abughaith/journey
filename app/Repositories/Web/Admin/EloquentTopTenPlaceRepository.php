<?php

namespace App\Repositories\Web\Admin;

use App\Entities\Web\Admin\TopTenPlaceEntity;
use App\Interfaces\Gateways\Web\Admin\TopTenPlaceRepositoryInterface;
use App\Models\TopTen;


class EloquentTopTenPlaceRepository implements TopTenPlaceRepositoryInterface
{
    public function allTopTenPlaces()
    {
        $eloquentTopTenPlaces = TopTen::with('place')->get();
        $topTenPlaces = [];

        foreach ($eloquentTopTenPlaces as $eloquentTopTenPlace) {
            $topTenPlaces[] = $this->convertToEntity($eloquentTopTenPlace);
        }

        return $topTenPlaces;
    }

    public function getTopTenPlace($topTenPlace)
    {
        return $this->convertToEntity($topTenPlace);
    }

    public function getTopTenPlaceById($topTenPlaceId)
    {
        $eloquentTopTenPlace = TopTen::find($topTenPlaceId);

        return $eloquentTopTenPlace ? $this->convertToEntity($eloquentTopTenPlace) : null;
    }

    public function createTopTenPlace($topTenPlaceDate)
    {
        $eloquentTopTenPlace = TopTen::create($topTenPlaceDate);

        return $this->convertToEntity($eloquentTopTenPlace);
    }

    public function updateTopTenPlace($id, $topTenPlaceDate)
    {
        $topTenPlace=TopTen::find($id);
        $topTenPlace->update($topTenPlaceDate);

        return $this->convertToEntity($topTenPlace);
    }


    public function deleteTopTenPlace($id)
    {
        $topTenPlace = TopTen::find($id);
        if ($topTenPlace) {
            $topTenPlace->delete();
        }
        return;
    }

    protected function convertToEntity(TopTen $eloquentTopTenPlace)
    {
        $topTenPlace = new TopTenPlaceEntity();
        $topTenPlace->setId($eloquentTopTenPlace->id);
        $topTenPlace->setRank($eloquentTopTenPlace->rank);
        $topTenPlace->setPlace($eloquentTopTenPlace->place->name);
        return $topTenPlace;
    }
}
