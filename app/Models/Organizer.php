<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class Organizer extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasTranslations;

    public $translatable = ['name'];
    public $guarded = [];

    public function eventOrganizerables()
    {
        return $this->morphedByMany(Event::class, 'organizerables');
    }

    public function volunteeringOrganizerables()
    {
        return $this->morphedByMany(Volunteering::class, 'organizerables');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('organizer')
            ->singleFile()
            ->registerMediaConversions(function (Media $media) {
                $this->addMediaConversion('organizer_app')->width(80)->height(80)->format('webp');
                $this->addMediaConversion('organizer_website')->width(250)->height(250)->format('webp');
            });
    }


}
