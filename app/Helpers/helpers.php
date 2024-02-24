<?php

use Illuminate\Support\Facades\Auth;

function AdminPermission($permission)
{
    return Auth::guard('admin')->user()->hasAnyPermission($permission);
}

function getLang()
{
    return Auth::guard('admin')->user()->lang;
}

function businessStatusTranslation($lang, $request)
{
    $business_status_translation = [
        'en' => [
            'closed' => 'Closed',
            'operational' => 'Operational',
            'temporary_closed' => 'Temporary Closed',
            'do_not_know' => 'We don\'t have any information about that'
        ],
        'ar' => [
            'closed' => 'مغلق',
            'operational' => 'شغال',
            'temporary_closed' => 'مغلق مؤقتا',
            'do_not_know' => 'ليس لدينا معلومة عن ذلك'

        ],
    ];
    return $business_status_translation[$lang][$request];
}

 function haversineDistance($userLat, $userLng, $placeLat, $placeLng)
{
    $earthRadius = 6371;

    $latDifference = deg2rad($placeLat - $userLat);
    $lngDifference = deg2rad($placeLng - $userLng);

    $a = sin($latDifference / 2) * sin($latDifference / 2) +
        cos(deg2rad($userLat)) * cos(deg2rad($placeLat)) *
        sin($lngDifference / 2) * sin($lngDifference / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    $distance = $earthRadius * $c;

    return $distance;
}
function daysTranslation($lang, $request)
{
    $dayTranslation = [
        'en' => [
            'Sunday' => 'Sunday',
            'Monday' => 'Monday',
            'Tuesday' => 'Tuesday',
            'Wednesday' => 'Wednesday',
            'Thursday' => 'Thursday',
            'Friday' => 'Friday',
            'Saturday' => 'Saturday',
        ],
        'ar' => [
            'Sunday' => 'الأحد',
            'Monday' => 'الاثنين',
            'Tuesday' => 'الثلاثاء',
            'Wednesday' => 'الأربعاء',
            'Thursday' => 'الخميس',
            'Friday' => 'الجمعة',
            'Saturday' => 'السبت',
        ],
    ];

    return $dayTranslation[$lang][$request];
}

