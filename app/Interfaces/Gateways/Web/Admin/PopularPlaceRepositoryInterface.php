<?php

namespace App\Interfaces\Gateways\Web\Admin;


interface PopularPlaceRepositoryInterface
{
    public function allPopularPlaces();

    public function getPopularPlaceById($popularId);

    public function getPopularPlace($popularPlace);

    public function createPopularPlace( $popularPlaceDate);

    public function updatePopularPlace($popularPlace, $popularPlaceDate);

    public function deletePopularPlace($popularPlace);
}
