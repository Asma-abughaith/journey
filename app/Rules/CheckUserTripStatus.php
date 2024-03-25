<?php

namespace App\Rules;

use App\Models\UsersTrip;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckUserTripStatus implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $userTrip = UsersTrip::where('user_id', request()->user_id)->where('trip_id', request()->trip_id)->first();

        if ($userTrip) {
            if ($userTrip->status == '1') {
                $fail('app.this-user-has-already-joined-this-trip');
            }

            if ($userTrip->status == '2') {
                $fail('app.this-user-has-been-rejected-from-this-trip');
            }
        }
    }
}
