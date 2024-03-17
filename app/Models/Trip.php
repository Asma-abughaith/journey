<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function gender()
    {
        switch ($this->sex) {
            case 0:
                return __('app.both');
            case 1:
                return __('app.male');
            case 2:
                return __('app.female');
        }
    }

    public function usersTrip()
    {
        return $this->hasMany(UsersTrip::class);
    }
}