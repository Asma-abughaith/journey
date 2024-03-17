<?php

namespace App\Rules;

use App\Models\Trip;
use App\Models\UsersTrip;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;

class CheckUserTripExistsRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (Trip::where('id',$value)->where('user_id', Auth::guard('api')->user()->id)->exists()) {
            $fail('You are the owner of trip so you can\'t cancel the join ');
        }
        if (!UsersTrip::where('user_id', Auth::guard('api')->user()->id)->whereIn('status',[0,1])->where($attribute,$value)->exists()) {
            $fail('You didn\'t have join trip to cancel');
        }


    }
}
