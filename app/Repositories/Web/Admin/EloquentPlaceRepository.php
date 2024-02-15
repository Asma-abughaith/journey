<?php

namespace App\Repositories\Web\Admin;

use App\Entities\Web\Admin\PlaceEntity;
use App\Interfaces\Gateways\Web\Admin\PlaceRepositoryInterface;
use App\Models\Place;

class EloquentPlaceRepository implements PlaceRepositoryInterface
{

    public function getAllPlaces()
    {
        $eloquentPlaces = Place::with('subCategory')->get();
        $places = [];

        foreach ($eloquentPlaces as $eloquentPlace) {
            $places[] = $this->convertToEntity($eloquentPlace);
        }

        return $places;
    }

    public function getPlace($places)
    {
        return $this->convertToEntity($places);
    }

    public function getPlaceById($placeId)
    {
        $eloquentPlace = Place::find($placeId);

        return $eloquentPlace ? $this->convertToEntity($eloquentPlace) : null;
    }

    public function createPlace(array $placeData, array $imageData, array $imageGallery)
    {
        $eloquentPlace = Place::create($placeData);
        $eloquentPlace->setTranslations('name', $placeData['name']);
        $eloquentPlace->setTranslations('description', $placeData['description']);
        $eloquentPlace->setTranslations('address', $placeData['address']);

        if ($imageData !== null) {
            $eloquentPlace->addMediaFromRequest('image')->toMediaCollection('main_place');
        }

        if ($imageGallery !== null) {
            foreach ($imageGallery as $key => $singleImage) {
                $eloquentPlace->addMediaFromRequest('image')->toMediaCollection('place_gallery');
            }
        }

        return $this->convertToEntity($eloquentPlace);
    }

    public function updatePlace($place, array $placeData, array $imageData, array $imageGallery)
    {

        $place->update($placeData);
        $place->setTranslations('name', $placeData['name']);
        $place->setTranslations('description', $placeData['description']);
        $place->setTranslations('address', $placeData['address']);

        if (isset($imageData['image']) && $imageData['image'] != null) {
            $place->addMediaFromRequest('image')->toMediaCollection('main_place');
        }

        // In Process
        if (isset($imageGallery['image']) && $imageGallery['image'] != null) {
            $place->addMediaFromRequest('image')->toMediaCollection('place_gallery');
        }

        return $this->convertToEntity($place);
    }

    public function deletePlace($place)
    {
        if ($place) {
            $place->delete();
        }
        return;
    }

    protected function convertToEntity(Place $eloquentPlace)
    {
        $names = $eloquentPlace->getTranslations('name');
        $descriptions = $eloquentPlace->getTranslations('description');
        $addresses = $eloquentPlace->getTranslations('address');

        $place = new PlaceEntity();
        $place->setId($eloquentPlace->id);
        $place->setName($eloquentPlace->name);
        $place->setNameEn($names['en']);
        $place->setNameAr($names['ar']);
        $place->setDescription($eloquentPlace->description);
        $place->setDescriptionEn($descriptions['en']);
        $place->setDescriptionAr($descriptions['ar']);
        $place->setAddress($eloquentPlace->address);
        $place->setAddressEn($addresses['en']);
        $place->setAddressAr($addresses['ar']);
        $place->setBusinessStatus($eloquentPlace->business_status);
        $place->setGoogleMapUrl($eloquentPlace->google_map_url);
        $place->setLongitude($eloquentPlace->longitude);
        $place->setLatitude($eloquentPlace->latitude);
        $place->setPhoneNumber($eloquentPlace->phone_number);
        $place->setPriceLevel($eloquentPlace->price_level);
        $place->setWebsite($eloquentPlace->website);
        $place->setRating($eloquentPlace->rating);
        $place->setTotalUserRating($eloquentPlace->total_user_rating);
        $place->setRegion($eloquentPlace->region);
        $place->setSubCategory($eloquentPlace->sub_category);

        // in process
        $place->setBusinessStatusEn('');
        $place->setBusinessStatusAr('');
        $place->setMainImage($eloquentPlace->main_image);
        $place->setGallery($eloquentPlace->gallery);

        return $place;
    }
}