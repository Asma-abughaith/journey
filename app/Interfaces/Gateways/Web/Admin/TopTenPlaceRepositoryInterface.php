<?php

namespace App\Interfaces\Gateways\Web\Admin;


interface TopTenPlaceRepositoryInterface
{
    public function allTopTenPlaces();

    public function getTopTenPlaceById($topTenPlaceId);

    public function getTopTenPlace($topTenPlace);

    public function createTopTenPlace( $topTenPlaceDate);

    public function updateTopTenPlace($topTenPlace, $topTenPlaceDate);

    public function deleteTopTenPlace($id);
}
