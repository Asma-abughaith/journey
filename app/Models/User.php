<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\Users\UserEmailVerificationNotification;
use App\Notifications\Users\UserRestPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
//use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function sendEmailVerificationNotification()
    {
        $this->notify(new UserEmailVerificationNotification());
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new UserRestPasswordNotification($token));
    }

    public function plans()
    {
        return $this->morphMany('App\Models\Plan', 'creator');
    }

    public function findForPassport($username)
    {
        return $this->where('email', $username)->orWhere('username', $username)->first();
    }

    public function favoritePlaces()
    {
        return $this->morphedByMany(Place::class, 'favorable');
    }

    public function favoritePlans()
    {
        return $this->morphedByMany(Plan::class, 'favorable');
    }

    public function visitedPlace()
    {
        return $this->belongsToMany(Place::class, 'visited_places', 'user_id', 'place_id');
    }

    public function eventInterestables()
    {
        return $this->morphedByMany(Event::class, 'interestable')->withTimestamps();
    }

    public function volunteeringInterestables()
    {
        return $this->morphedByMany(Volunteering::class, 'interestable')->withTimestamps();
    }

    public function favoriteEvent()
    {
        return $this->morphedByMany(Event::class, 'favorable')->withTimestamps();
    }

    public function favoriteVolunteering()
    {
        return $this->morphedByMany(Volunteering::class, 'favorable')->withTimestamps();
    }

    public function favoriteTrip()
    {
        return $this->morphedByMany(Trip::class, 'favorable')->withTimestamps();
    }

    public function reviewTrip()
    {
        return $this->morphedByMany(Trip::class, 'reviewable')->withTimestamps();
    }

    public function likeReview()
    {
        return $this->belongsTo(ReviewLike::class, 'user_id');
    }
}
