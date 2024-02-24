<?php

namespace App\Interfaces\Presenters\Web\Admin;


use App\Entities\Web\Admin\PlaceEntity;
use App\Entities\Web\Admin\TopTenPlaceEntity;

class TopTenPlacePresenter
{
    public function presentAllTenPlacePlaces($places)
    {
        $formattedTopTenPlacePlaces = [];

        foreach ($places as $place) {
            $formattedTopTenPlacePlaces[] = $this->formatPlace($place);
        }
        return $formattedTopTenPlacePlaces;
    }

    public function presentTenPlacePlace($place)
    {
        return $this->formatPlace($place);
    }

    protected function formatPlace(TopTenPlaceEntity $place)
    {
        return [
            'id' => $place->getId(),
            'rank' => $place->getRank(),
            'place' => $place->getPlace(),

        ];
    }
}
