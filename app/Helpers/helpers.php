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
