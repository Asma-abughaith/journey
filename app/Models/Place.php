<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class Place extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasTranslations;

    public $translatable = ['name', 'description', 'address'];
    public $guarded = [];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function openingHours()
    {
        return $this->hasMany(OpeningHour::class);
    }

    public function popularPlaces()
    {
        return $this->hasOne(PopularPlace::class);
    }

    public function topTenPlaces()
    {
        return $this->hasOne(TopTen::class);
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('main_place')
            ->singleFile()
            ->registerMediaConversions(function (Media $media) {
                $this->addMediaConversion('main_place_app')->width(80)->height(80)->format('webp');
                $this->addMediaConversion('main_place_website')->width(250)->height(250)->format('webp');
            });

        $this->addMediaCollection('place_gallery')
            ->registerMediaConversions(function (Media $media) {
                $this->addMediaConversion('place_gallery_app')->width(419)->height(419)->format('jpg');
                $this->addMediaConversion('place_gallery_website')->width(250)->height(250)->format('webp');
            });
    }

    public function category()
    {
        return $this->hasOneThrough(
            Category::class, // Target model
            SubCategory::class, // Intermediate model
            'id', // Foreign key on SubCategory table
            'id', // Foreign key on Category table
            'sub_category_id', // Local key on Place table
            'category_id' // Local key on SubCategory table
        );
    }

    public function favoritedBy()
    {
        return $this->morphToMany(User::class, 'favorable');
    }


    public function visitors()
    {
        return $this->belongsToMany(User::class, 'visited_places', 'place_id', 'user_id');
    }
}
