<?php

namespace App\Rules;

use App\Models\VisitedPlace;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;

class CheckIfExistsInVistedPlaceTableRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $userId = Auth::guard('api')->user()->id;

        if (VisitedPlace::where('user_id', $userId)->where($attribute,$value)->exists()) {
            $fail('This place already in your visited place');
        }
    }
}
