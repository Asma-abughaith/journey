<?php

use Illuminate\Support\Facades\Auth;

function AdminPermission($permission)
{
    return Auth::guard('admin')->user()->hasAnyPermission($permission);
}

function getLang(){
    return Auth::guard('admin')->user()->lang;
}

function businessStatusTranslation($lang, $request){
    $business_status_translation =[
        'en'=>[
            'closed'=>'Closed',
            'operational'=>'Operational',
            'temporary_closed'=>'Temporary Closed'
        ],
        'ar'=>[
            'closed'=>'مغلق',
            'operational'=>'شغال',
            'temporary_closed'=>'مغلق مؤقتا'
        ],
    ];
    return $business_status_translation[$lang][$request];
}

