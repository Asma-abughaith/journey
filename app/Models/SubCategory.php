<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class SubCategory extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;

    use HasTranslations;

    public $translatable = ['name'];
    public $guarded=[];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('subcategory')
            ->singleFile()
            ->registerMediaConversions(function (Media $media) {
                $this->addMediaConversion('subcategory_app')->width(80)->height(80)->format('webp');
                $this->addMediaConversion('subcategory_website')->width(250)->height(250)->format('webp');
            });
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

}
