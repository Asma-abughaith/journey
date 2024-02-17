<?php

namespace App\Interfaces\Presenters\Web\Admin;


use App\Entities\Web\Admin\PlaceEntity;

class PlacePresenter
{
    public function presentAllPlace($places)
    {
        $formattedPlaces = [];

        foreach ($places as $place) {
            $formattedPlaces[] = $this->formatPlace($place);
        }
        return $formattedPlaces;
    }

    public function presentPlace($place)
    {
        return $this->formatPlace($place);
    }

    protected function formatPlace(PlaceEntity $place)
    {
        return [
            'id' => $place->getId(),
            'name' => $place->getName(),
            'name_en' => $place->getNameEn(),
            'name_ar' => $place->getNameAr(),
            'description' => $place->getDescription(),
            'description_en' => $place->getDescriptionEn(),
            'description_ar' => $place->getDescriptionAr(),
            'address' => $place->getAddress(),
            'address_en' => $place->getAddressEn(),
            'address_ar' => $place->getAddressAr(),
            'business_status' => $place->getBusinessStatus(),
            'business_status_en' => $place->getBusinessStatusEn(),
            'business_status_ar' => $place->getBusinessStatusAr(),
            'google_map_url' => $place->getGoogleMapUrl(),
            'longitude' => $place->getLongitude(),
            'latitude' => $place->getLatitude(),
            'phone_number' => $place->getPhoneNumber(),
            'price_level' => $place->getPriceLevel(),
            'website' => $place->getWebsite(),
            'rating' => $place->getRating(),
            'total_user_rating' => $place->getTotalUserRating(),
            'region' => $place->getRegion(),
            'main_image' => $place->getMainImage(),
            'sub_category' => $place->getSubCategory(),
            'gallery' => $place->getGallery(),
            'gallery' => $place->getGallery(),
            'tags' => $place->getTags(),
            'features' => $place->getFeatures(),
            'opening_hours' => $place->getOpeningHours()
        ];
    }
}
