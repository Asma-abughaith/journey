<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviewable extends Model
{
    use HasFactory;

    protected $table = 'reviewables';

    protected $guarded = [];

    public function like()
    {
        return $this->belongsToMany(User::class, 'review_likes', 'review_id', 'user_id')->withPivot('status');
    }
}
