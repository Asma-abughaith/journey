<?php

namespace App\Rules;

use App\Models\Trip;
use App\Models\UsersTrip;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;

class CheckAgeGenderExistenceRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $trip = Trip::find(request()->trip_id);

        if ($trip) {
            $user = Auth::guard('api')->user();
            $birthday = $user->birthday;
            if (!$birthday) {
                $fail('you should enter your birthday first');
            }

            $birthday = new \DateTime($birthday);
            $currentDate = new \DateTime();
            $age = $currentDate->diff($birthday)->y;

            if (!(json_decode($trip->age_range)->min <= $age && json_decode($trip->age_range)->max >= $age) && ($trip->sex == $user->sex || $trip->sex == 0)) {
                $fail('You are not allowed to join this trip. because your age or sex not acceptable');
            }

            if (UsersTrip::where('trip_id', request()->trip_id)->where('user_id', Auth::guard('api')->user()->id)->where('status', '2')->exists()) {
                $fail('Your Join request Cancelled by Owner so you can\'t to join this trip again.');
            }

            if (UsersTrip::where('trip_id', request()->trip_id)->where('user_id', Auth::guard('api')->user()->id)->whereIn('status',['0','1'])->exists()) {
                $fail('You already join this trip.');
            }

            if (Trip::where('user_id', Auth::guard('api')->user()->id)->exists()) {
                $fail('You the creator of trip you can\'t to join this trip.');
            }
        }
    }
}