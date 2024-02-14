<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Place extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = ['name','description','address'];
    public $guarded=[];

    public function region(){
        return $this->belongsTo(Region::class);
    }

    public function openingHours(){
        return $this->hasMany(OpeningHour::class);
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
