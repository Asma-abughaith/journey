<?php

namespace App\Interfaces\Presenters\Web\Admin;


use App\Entities\Web\Admin\PlaceEntity;
use App\Entities\Web\Admin\PopularPlaceEntity;
use App\Entities\Web\Admin\TopTenPlaceEntity;

class PopularPlacePresenter
{
    public function presentAllPopularPlaces($places)
    {
        $formattedPopularPlaces = [];

        foreach ($places as $place) {
            $formattedPopularPlaces[] = $this->formatPlace($place);
        }
        return $formattedPopularPlaces;
    }

    public function presentPopularPlace($place)
    {
        return $this->formatPlace($place);
    }

    protected function formatPlace(PopularPlaceEntity $place)
    {
        return [
            'id' => $place->getId(),
            'price' => $place->getPrice(),
            'place' => $place->getPlace(),

        ];
    }
}
