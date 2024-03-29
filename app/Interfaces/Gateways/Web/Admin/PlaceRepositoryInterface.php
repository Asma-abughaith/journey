<?php

namespace App\Interfaces\Gateways\Web\Admin;


interface PlaceRepositoryInterface
{
    public function getAllPlaces();

    public function getPlaceById($placeId);

    public function getPlace($place);

    public function createPlace($placeData,  $imageData,  $imageGallery,  $tags,  $opening_hours,  $features, $placeType);

    public function updatePlace($place, $placeData, $imageData, $imageGallery,  $tags,  $opening_hours,  $features, $placeType);

    public function deletePlace($place);

    public function deleteImage($id);
}
