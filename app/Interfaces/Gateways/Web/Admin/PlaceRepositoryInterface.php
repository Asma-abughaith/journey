<?php

namespace App\Interfaces\Gateways\Web\Admin;


interface PlaceRepositoryInterface
{
    public function getAllPlaces();

    public function getPlaceById($placeId);

    public function getPlace($place);

    public function createPlace(array $placeData, array $imageData, array $imageGallery);

    public function updatePlace($place, array $placeData, array $imageData , array $imageGallery);

    public function deleteSubCategory($place);
}
