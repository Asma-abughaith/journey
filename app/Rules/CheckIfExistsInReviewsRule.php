<?php

namespace App\Rules;

use App\Models\Trip;
use App\Models\UsersTrip;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckIfExistsInReviewsRule implements ValidationRule
{
    protected $reviewable_type;

    public function __construct($reviewable_type)
    {
        $this->reviewable_type = $reviewable_type;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $userId = Auth::guard('api')->user()->id;
        $exists = DB::table('reviewables')
            ->where('user_id', $userId)
            ->where('reviewable_type', $this->reviewable_type)
            ->where('reviewable_id', $value)
            ->exists();
        if ($exists) {
            $fail(__('app.you-already-make-review-for-this'));
        }

        $attendance = UsersTrip::where('user_id',$userId)->where($attribute,$value)->where('status','1')->exists();
        if(!$attendance){
            $fail(__('app.you-are-not-attendance-in-this'));
        }

        $trip_date = Trip::find($value)?->date_time;
        $now = now()->setTimezone('Asia/Riyadh');
        if($trip_date > $now){
            $fail(__('app.you-can\'t-make-review-for-upcoming-trip'));
        }

    }
}
