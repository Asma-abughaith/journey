<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class Event extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasTranslations;

    public $translatable = ['name', 'description', 'address'];
    public $guarded = [];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function organizers()
    {
        return $this->morphToMany(Organizer::class, 'organizerables');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('event')
            ->singleFile()
            ->registerMediaConversions(function (Media $media) {
                $this->addMediaConversion('event_app')->width(80)->height(80)->format('webp');
                $this->addMediaConversion('event_website')->width(250)->height(250)->format('webp');
            });
    }

}
