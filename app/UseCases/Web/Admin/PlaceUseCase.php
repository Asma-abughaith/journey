<?php

namespace App\UseCases\Web\Admin;

use App\Interfaces\Gateways\Web\Admin\PlaceRepositoryInterface;

class PlaceUseCase
{
    protected $placeRepository;

    public function __construct(PlaceRepositoryInterface $placeRepository)
    {
        $this->placeRepository = $placeRepository;
    }

    public function allPlaces()
    {
        return $this->placeRepository->getAllPlaces();
    }

    public function getPlace($place)
    {
        return $this->placeRepository->getPlace($place);
    }

    public function getPlaceById($placeId)
    {
        return $this->placeRepository->getPlaceById($placeId);
    }

    public function createPlace($request)
    {
        $translator = ['en' => $request['name_en'], 'ar' => $request['name_ar']];
        $translatorDescription = ['en' => $request['description_en'], 'ar' => $request['description_ar']];
        $translatorAddress = ['en' => $request['address_en'], 'ar' => $request['address_ar']];

        return $this->placeRepository->createPlace(
            [
                'name' => $translator,
                'description' => $translatorDescription,
                'address' => $translatorAddress,
                'google_map_url' => $request['google_map_url'],
                'longitude' => $request['longitude'],
                'latitude' => $request['latitude'],
                'phone_number' => $request['phone_number'],
                'price_level' => $request['price_level'],
                'website' => $request['website'],
                'rating' => $request['rating'],
                'total_user_rating' => $request['total_user_rating'],
                'region_id' => $request['region_id'],
                'sub_category_id' => $request['sub_category_id'],
                'business_status' => $request['business_status'],
            ],
            ['main_image' => isset($request['main_image']) ? $request['main_image'] : null],
            isset($request['gallery_images'])?$request['gallery_images']:null,
            $request['tags_id'],
            [
                'day_of_week' => isset($request['day_of_week'])?$request['day_of_week']:null,
                'opening_hours' => isset($request['opening_hours'])?$request['opening_hours']:null,
                'closing_hours' => isset($request['closing_hours'])?$request['closing_hours']:null
            ],
            $request['feature_id'],
        );
    }

    public function updatePlace($place, $request)
    {
        $translator = ['en' => $request['name_en'], 'ar' => $request['name_ar']];
        return $this->placeRepository->updatePlace(
            $place,
            [
                'name' => $translator,
            ],
            ['image' => isset($request['image']) ? isset($request['image']) : null],
            ['image' => isset($request['image']) ? isset($request['image']) : null]
        );
    }

    public function deletePlace($place)
    {
        return $this->placeRepository->deletePlace($place);
    }
}
