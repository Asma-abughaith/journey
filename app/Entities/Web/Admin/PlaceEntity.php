<?php

namespace App\Entities\Web\Admin;

class PlaceEntity
{

    private $id;
    private $name;
    private $name_en;
    private $name_ar;
    private $description;
    private $description_en;
    private $description_ar;
    private $address;
    private $address_en;
    private $address_ar;
    private $business_status;
    private $business_status_en;
    private $business_status_ar;
    private $google_map_url;
    private $longitude;
    private $latitude;
    private $phone_number;
    private $price_level;
    private $website;
    private $rating;
    private $total_user_rating;
    private $region;
    private $main_image;
    private $sub_category;
    private $place_type = [];
    private $gallery = [];
    private $tags = [];
    private $features = [];
    private $openingHours = [];

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getNameEn()
    {
        return $this->name_en;
    }

    /**
     * @param mixed $name_en
     */
    public function setNameEn($name_en): void
    {
        $this->name_en = $name_en;
    }

    /**
     * @return mixed
     */
    public function getNameAr()
    {
        return $this->name_ar;
    }

    /**
     * @param mixed $name_ar
     */
    public function setNameAr($name_ar): void
    {
        $this->name_ar = $name_ar;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDescriptionEn()
    {
        return $this->description_en;
    }

    /**
     * @param mixed $description_en
     */
    public function setDescriptionEn($description_en): void
    {
        $this->description_en = $description_en;
    }

    /**
     * @return mixed
     */
    public function getDescriptionAr()
    {
        return $this->description_ar;
    }

    /**
     * @param mixed $description_ar
     */
    public function setDescriptionAr($description_ar): void
    {
        $this->description_ar = $description_ar;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address): void
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getAddressEn()
    {
        return $this->address_en;
    }

    /**
     * @param mixed $address_en
     */
    public function setAddressEn($address_en): void
    {
        $this->address_en = $address_en;
    }

    /**
     * @return mixed
     */
    public function getAddressAr()
    {
        return $this->address_ar;
    }

    /**
     * @param mixed $address_ar
     */
    public function setAddressAr($address_ar): void
    {
        $this->address_ar = $address_ar;
    }

    /**
     * @return mixed
     */
    public function getBusinessStatus()
    {
        return $this->business_status;
    }

    /**
     * @param mixed $business_status
     */
    public function setBusinessStatus($business_status): void
    {
        $this->business_status = $business_status;
    }

    /**
     * @return mixed
     */
    public function getBusinessStatusEn()
    {
        return $this->business_status_en;
    }

    /**
     * @param mixed $business_status_en
     */
    public function setBusinessStatusEn($business_status_en): void
    {
        $this->business_status_en = $business_status_en;
    }

    /**
     * @return mixed
     */
    public function getBusinessStatusAr()
    {
        return $this->business_status_ar;
    }

    /**
     * @param mixed $business_status_ar
     */
    public function setBusinessStatusAr($business_status_ar): void
    {
        $this->business_status_ar = $business_status_ar;
    }

    /**
     * @return mixed
     */
    public function getGoogleMapUrl()
    {
        return $this->google_map_url;
    }

    /**
     * @param mixed $google_map_url
     */
    public function setGoogleMapUrl($google_map_url): void
    {
        $this->google_map_url = $google_map_url;
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param mixed $longitude
     */
    public function setLongitude($longitude): void
    {
        $this->longitude = $longitude;
    }

    /**
     * @return mixed
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param mixed $latitude
     */
    public function setLatitude($latitude): void
    {
        $this->latitude = $latitude;
    }

    /**
     * @return mixed
     */
    public function getPhoneNumber()
    {
        return $this->phone_number;
    }

    /**
     * @param mixed $phone_number
     */
    public function setPhoneNumber($phone_number): void
    {
        $this->phone_number = $phone_number;
    }

    /**
     * @return mixed
     */
    public function getPriceLevel()
    {
        return $this->price_level;
    }

    /**
     * @param mixed $price_level
     */
    public function setPriceLevel($price_level): void
    {
        $this->price_level = $price_level;
    }

    /**
     * @return mixed
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * @param mixed $website
     */
    public function setWebsite($website): void
    {
        $this->website = $website;
    }

    /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param mixed $rating
     */
    public function setRating($rating): void
    {
        $this->rating = $rating;
    }

    /**
     * @return mixed
     */
    public function getTotalUserRating()
    {
        return $this->total_user_rating;
    }

    /**
     * @param mixed $total_user_rating
     */
    public function setTotalUserRating($total_user_rating): void
    {
        $this->total_user_rating = $total_user_rating;
    }

    /**
     * @return mixed
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param mixed $region
     */
    public function setRegion($region): void
    {
        $this->region = $region;
    }

    /**
     * @return mixed
     */
    public function getMainImage()
    {
        return $this->main_image;
    }

    /**
     * @param mixed $main_image
     */
    public function setMainImage($main_image): void
    {
        $this->main_image = $main_image;
    }

    /**
     * @return mixed
     */
    public function getSubCategory()
    {
        return $this->sub_category;
    }

    /**
     * @param mixed $sub_category
     */
    public function setSubCategory($sub_category): void
    {
        $this->sub_category = $sub_category;
    }

    /**
     * @return mixed
     */
    public function getPlaceType()
    {
        return $this->place_type;
    }

    /**
     * @param mixed $place_type
     */
    public function setPlaceType($place_type): void
    {
        $this->place_type = [
            'id' => $place_type->id,
            'place_id' => $place_type->place_id,
            'rank' => $place_type->rank
        ];
    }

    /**
     * @return mixed
     */
    public function getGallery()
    {
        return $this->gallery;
    }

    /**
     * @param mixed $gallery=[]
     */
    public function setGallery($gallery)
    {

        foreach ($gallery as $img) {
            $this->gallery[] = [
                'id' => $img->id,
                'url' => $img->getUrl()
            ];
        }
    }

    public function setTags($tags)
    {
        foreach ($tags as $tag) {
            $this->tags[] = [
                'id' => $tag->id,
                'name' => $tag->name,
            ];
        }
    }

    public function getTags()
    {
        return $this->tags;
    }

    public function setFeatures($features)
    {
        foreach ($features as $feature) {
            $this->features[] = [
                'id' => $feature->id,
                'name' => $feature->name,
            ];
        }
    }

    public function getFeatures()
    {
        return $this->features;
    }

    public function setOpeningHours($openingHours)
    {
        $this->openingHours = [];

        foreach ($openingHours as $key => $openingHour) {
            foreach ($openingHour as $day_key => $day) {
                $this->openingHours[$key][$day_key] = [
                    'id' => $day->id,
                    'day_of_week' => $day->day_of_week,
                    'opening_time' => $day->opening_time,
                    'closing_time' => $day->closing_time,
                ];
            }
        }
    }


    public function getOpeningHours()
    {
        return $this->openingHours;
    }
}
