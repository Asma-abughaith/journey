<?php

namespace App\Repositories\Web\Admin;

use App\Entities\Web\Admin\PlaceEntity;
use App\Interfaces\Gateways\Web\Admin\PlaceRepositoryInterface;
use App\Models\OpeningHour;
use App\Models\Place;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class EloquentPlaceRepository implements PlaceRepositoryInterface
{

    public function getAllPlaces()
    {
        $eloquentPlaces = Place::with('subCategory')->with(['region', 'subCategory'])->get();
        $places = [];

        foreach ($eloquentPlaces as $eloquentPlace) {
            $places[] = $this->convertToEntity($eloquentPlace);
        }

        return $places;
    }

    public function getPlace($place)
    {
        return $this->convertToEntity($place);
    }

    public function getPlaceById($placeId)
    {
        $eloquentPlace = Place::find($placeId);

        return $eloquentPlace ? $this->convertToEntity($eloquentPlace) : null;
    }

    public function createPlace( $placeData,  $imageData,  $imageGallery,  $tags,  $opening_hours, $features,$placeType)
    {
        $eloquentPlace = Place::create($placeData);
        $eloquentPlace->setTranslations('name', $placeData['name']);
        $eloquentPlace->setTranslations('description', $placeData['description']);
        $eloquentPlace->setTranslations('address', $placeData['address']);
        $eloquentPlace->tags()->attach(array_values($tags));

        if(isset($opening_hours['day_of_week'])){
            foreach ($opening_hours['day_of_week'] as $key => $value) {
                foreach (array_values($value) as $day) {
                    $openingHour = new OpeningHour();
                    $openingHour->day_of_week = $day;
                    $openingHour->opening_time = $opening_hours['opening_hours'][$key];
                    $openingHour->closing_time = $opening_hours['closing_hours'][$key];
                    $eloquentPlace->openingHours()->save($openingHour);
                }
            }
        }


        if (!empty($placeType)) {
            if ($placeType[0]['placeType'] == 'popular') {
                $eloquentPlace->popularPlaces()->create([
                    'price' => $placeType[0]['price'],
                ]);
            } elseif ($placeType[0]['placeType'] == 'top_ten') {
                $eloquentPlace->topTenPlaces()->create([
                    'rank' => $placeType[0]['rank'],
                ]);
            }
        }


        if(isset($features)){
            $eloquentPlace->features()->attach(array_values($features));
        }

        if ($imageData !== null) {
            $eloquentPlace->addMediaFromRequest('main_image')->toMediaCollection('main_place');
        }

        if ($imageGallery !== null) {
            foreach ($imageGallery as $image) {
                $eloquentPlace->addMedia($image)->toMediaCollection('place_gallery');
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

    public function deleteImage($id){
        if ($id) {
            Media::find($id)->delete();
        }
        return;
    }

    protected function convertToEntity(Place $eloquentPlace)
    {
        $lang = getLang();
        $names = $eloquentPlace->getTranslations('name');
        $descriptions = $eloquentPlace->getTranslations('description');
        $addresses = $eloquentPlace->getTranslations('address');

        $openingHours = $eloquentPlace->openingHours->groupBy('opening_time');
        $openingHours = $openingHours->values();

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
        $place->setGoogleMapUrl($eloquentPlace->google_map_url);
        $place->setLongitude($eloquentPlace->longitude);
        $place->setLatitude($eloquentPlace->latitude);
        $place->setPhoneNumber($eloquentPlace->phone_number);
        $place->setPriceLevel($eloquentPlace->price_level);
        $place->setWebsite($eloquentPlace->website);
        $place->setRating($eloquentPlace->rating);
        $place->setTotalUserRating($eloquentPlace->total_user_rating);
        $place->setRegion($eloquentPlace->region->name);
        $place->setSubCategory($eloquentPlace->subCategory->name);
        $place->setBusinessStatus(businessStatusTranslation($lang, $eloquentPlace->business_status));
        $place->setBusinessStatusEn(businessStatusTranslation('en', $eloquentPlace->business_status));
        $place->setBusinessStatusAr(businessStatusTranslation('ar', $eloquentPlace->business_status));
        $place->setTags($eloquentPlace->tags);
        $place->setFeatures($eloquentPlace->features);
        $place->setOpeningHours($openingHours);
        $place->setMainImage($eloquentPlace->getFirstMediaUrl('main_place', 'main_place_website'));
        $place->setGallery($eloquentPlace->getMedia('place_gallery'));

        return $place;
    }
}
