<?php
// app/Validation/CheckNameEnAndGuardExistRule.php

namespace App\Validation;

use Illuminate\Contracts\Validation\Rule;

use Spatie\Permission\Models\Role;

// Replace YourModel with the appropriate model name

class OpenCloseTimeRule implements Rule
{

    public function passes($attribute, $value)
    {
        $openingHours = request()->input('opening_hours');
        $closingHours=request()->input('opening_hours');
        $weekDays = request()->input('day_of_week');


        if(!isset($weekDays) && isset($openingHours) && isset($closingHours)){
            return true;
        }

        if( $weekDays !== null &&  $openingHours[0] == null ){
           return false;
       }

        if($weekDays !== null &&  $openingHours[0] == null ){
            return false;
        }

        if( $weekDays == null &&  $closingHours[0] !== null ){
            return false;
        }

        if( $weekDays == null && $openingHours[0] !==null ){
            return false;
        }
    }

    public function message()
    {
        return 'You Should put valid opening hours and close hours and week of days';
    }
}
