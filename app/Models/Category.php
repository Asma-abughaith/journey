<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;


class Category extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;

    use HasTranslations;

    public $translatable = ['name'];
    public $guarded=[];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('category')
            ->singleFile()
            ->registerMediaConversions(function (Media $media) {
                $this->addMediaConversion('category_app')->width(80)->height(80)->format('webp');
                $this->addMediaConversion('category_website')->width(250)->height(250)->format('webp');
            });
    }

    public function subcategories(){
        return $this->hasMany(SubCategory::class);
    }

    public function places()
    {
        return $this->hasManyThrough(
            Place::class,
            SubCategory::class,
            'category_id', // Foreign key on SubCategory table
            'sub_category_id' // Foreign key on Place table
        );
    }

}
