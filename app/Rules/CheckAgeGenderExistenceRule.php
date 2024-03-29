<?php

namespace App\Rules;

use App\Models\Trip;
use App\Models\UsersTrip;
use Carbon\Carbon;
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
            $currentDate->setTimezone(new \DateTimeZone('Asia/Riyadh'));
            $age = abs($currentDate->diff($birthday)->y);
            $tripDateTime = new \DateTime($trip->date_time);


            if ($trip->attendance_number == UsersTrip::where('trip_id', request()->trip_id)->where('status', '1')->count()) {
                $fail(__('app.this-trip-has-exceeded-the-required-number-You-can-return-to-the-home-page-and-search-for-another-trip'));
            }

            if ($currentDate->format('Y-m-d H:i:s') > $tripDateTime->format('Y-m-d H:i:s')) {
                $fail(__('app.this-journey-has-already-moved-on.-you-can-return-to-the-home-page-and-search-for-another-trip'));
            }

            if (!(json_decode($trip->age_range)->min <= $age && json_decode($trip->age_range)->max >= $age) && ($trip->sex == $user->sex || $trip->sex == 0)) {
                $fail(__('app.you-are-not-allowed-to-join-this-trip.-because-your-age-or-sex-not-acceptable'));
            }

            if (UsersTrip::where('trip_id', request()->trip_id)->where('user_id', Auth::guard('api')->user()->id)->where('status', '2')->exists()) {
                $fail(__('app.your-Join-request-cancelled-by-owner-so-you-cant-to-join-this-trip-again.'));
            }

            if (UsersTrip::where('trip_id', request()->trip_id)->where('user_id', Auth::guard('api')->user()->id)->whereIn('status', ['0', '1'])->exists()) {
                $fail(__('app.you-already-join-this-trip.'));
            }

            if (Trip::where('user_id', Auth::guard('api')->user()->id)->where('id', request()->trip_id)->exists()) {
                $fail(__('app.you-the-creator-of-trip-you-cant-to-join-this-trip.'));
            }

            // Check if the user is already on a trip and wants to join another trip on the same date.
            // Retrieve the first active trip that the user has joined.
            $hasJoinTrip = UsersTrip::where('user_id', Auth::guard('api')->user()->id)->where('status', '1')->first();
            // Check if the user has joined any trip.
            if ($hasJoinTrip) {
                // Parse the dates of the current trip and the trip the user wants to join.
                $dateJoinTrip = Carbon::parse($hasJoinTrip->trip->date_time)->format('Y-m-d');
                $dateTrip =  Carbon::parse($trip->date_time)->format('Y-m-d');
                // Check if the user is trying to join a trip on the same date as the one they're already on.
                if ($dateJoinTrip == $dateTrip) {
                    $fail(__('app.you-already-join-has-trip.'));
                }
            }
        }
    }
}
