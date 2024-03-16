<?php

namespace App\Rules;

use App\Models\Trip;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;

class CheckIfCanMakeTripRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $last_trip = Trip::where('user_id', Auth::guard('api')->user()->id)->latest()->first();
        $date_time = Carbon::createFromFormat('Y-m-d H:i:s', request()->date . ' ' . request()->time);
        if ($last_trip) {
            $last_trip_date = Carbon::createFromFormat('Y-m-d H:i:s', $last_trip->date_time);
            if ($date_time->diffInMonths($last_trip_date) < 1) {
                $fail(__('app.cant-make-trip-in-less-than-one-month'));
            }
        }
    }
}
