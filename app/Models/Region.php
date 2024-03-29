<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Region extends Model
{
    use HasFactory,HasTranslations;

    public $translatable = ['name'];
    public $guarded=[];

    public function places(){
        return $this->hasMany(Place::class);
    }
}
