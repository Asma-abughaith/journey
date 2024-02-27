<?php

namespace App\Repositories\Web\Admin;

use App\Entities\Web\Admin\PlaceEntity;
use App\Interfaces\Gateways\Web\Admin\PlaceRepositoryInterface;
use App\Models\OpeningHour;
use App\Models\Place;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Str;

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

    public function createPlace($placeData,  $imageData,  $imageGallery,  $tags,  $opening_hours, $features, $placeType)
    {
        $eloquentPlace = Place::create($placeData);
        $eloquentPlace->setTranslations('name', $placeData['name']);
        $eloquentPlace->setTranslations('description', $placeData['description']);
        $eloquentPlace->setTranslations('address', $placeData['address']);
        $eloquentPlace->tags()->attach(array_values($tags));

        if (isset($opening_hours['day_of_week'])) {
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


        if (isset($features)) {
            $eloquentPlace->features()->attach(array_values($features));
        }

        if ($imageData !== null) {
            $extension = pathinfo($imageData['main_image']->getClientOriginalName(), PATHINFO_EXTENSION);
            $filename = Str::random(10) . '_' . time() . '.' . $extension;
            $eloquentPlace->addMediaFromRequest('main_image')->usingFileName($filename)->toMediaCollection('main_place');
        }

        if ($imageGallery !== null) {
            foreach ($imageGallery as $image) {
                $extension = pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);
                $filename = Str::random(10) . '_' . time() . '.' . $extension;
                $eloquentPlace->addMedia($image)->usingFileName($filename)->toMediaCollection('place_gallery');
            }
        }

        return $this->convertToEntity($eloquentPlace);
    }

    public function updatePlace($place,  $placeData,  $imageData,  $imageGallery,  $tags,  $opening_hours, $features, $placeType)
    {

        // ======================= General Information =======================
        $place->update($placeData);
        $place->setTranslations('name', $placeData['name']);
        $place->setTranslations('description', $placeData['description']);
        $place->setTranslations('address', $placeData['address']);

        // ======================= Main Image =======================
        if (isset($imageData['main_image']) && $imageData['main_image'] != null) {
            $extension = pathinfo($imageData['main_image']->getClientOriginalName(), PATHINFO_EXTENSION);
            $filename = Str::random(10) . '_' . time() . '.' . $extension;
            $place->addMediaFromRequest('main_image')->usingFileName($filename)->toMediaCollection('main_place');
        }

        // ======================= Gallery Image =======================
        if ($imageGallery !== null) {
            foreach ($imageGallery as $image) {
                $extension = pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);
                $filename = Str::random(10) . '_' . time() . '.' . $extension;
                $place->addMedia($image)->usingFileName($filename)->toMediaCollection('place_gallery');
            }
        }

        // ======================= Tags =======================
        $place->tags()->sync(array_values($tags));

        // ======================= Features =======================
        $place->features()->sync(array_values($features));

        // ======================= Place Type =======================
        if (!empty($placeType)) {
            if ($placeType[0]['placeType'] == 'popular') {
                $place->popularPlaces()->updateOrCreate([], ['price' => $placeType[0]['price']]);
                $place->topTenPlaces()->delete();
            } elseif ($placeType[0]['placeType'] == 'top_ten') {
                $place->topTenPlaces()->updateOrCreate([], ['rank' => $placeType[0]['rank']]);
                $place->popularPlaces()->delete();
            }
        } else {
            $place->popularPlaces()->delete();
            $place->topTenPlaces()->delete();
        }

        // ======================= Opening Hours =======================
        if (isset($opening_hours['day_of_week'])) {
            $daysOfWeek = array_values($opening_hours['day_of_week']);
            $openingTimes = array_values($opening_hours['opening_hours']);
            $closingTimes = array_values($opening_hours['closing_hours']);


            foreach ($daysOfWeek as $key => $days) {
                foreach ($days as $day) {
                    $existingOpeningHour = $place->openingHours()->where('day_of_week', $day)->first();
                    if ($existingOpeningHour) {
                        $existingOpeningHour->opening_time = $openingTimes[$key];
                        $existingOpeningHour->closing_time = $closingTimes[$key];
                        $existingOpeningHour->save();
                    } else {
                        $openingHour = new OpeningHour();
                        $openingHour->day_of_week = $day;
                        $openingHour->opening_time = $openingTimes[$key];
                        $openingHour->closing_time = $closingTimes[$key];
                        $place->openingHours()->save($openingHour);
                    }
                }
            }
            $flatDaysOfWeek = [];
            foreach ($daysOfWeek as $days) {
                $flatDaysOfWeek = array_merge($flatDaysOfWeek, $days);
            }
            $flatDaysOfWeek = array_unique($flatDaysOfWeek);
            $place->openingHours()->whereNotIn('day_of_week', $flatDaysOfWeek)->delete();
        } else {
            $place->openingHours()->delete();
        }

        return $this->convertToEntity($place);
    }

    public function deletePlace($place)
    {
        if ($place) {
            $place->tags()->sync([]);
            $place->delete();
        }
        return;
    }

    public function deleteImage($id)
    {
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

        $openingHours = $eloquentPlace->openingHours->groupBy(['opening_time', 'closing_time']);
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
        if (!empty($eloquentPlace->topTenPlaces)) {
            $place->setPlaceType($eloquentPlace->topTenPlaces);
        } else if (!empty($eloquentPlace->popularPlaces)) {
            $place->setPlaceType($eloquentPlace->popularPlaces);
        }
        $place->setFeatures($eloquentPlace->features);
        $place->setOpeningHours($openingHours);
        $place->setMainImage($eloquentPlace->getFirstMediaUrl('main_place', 'main_place_website'));
        $place->setGallery($eloquentPlace->getMedia('place_gallery'));

        return $place;
    }
}
