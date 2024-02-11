<?php

use Illuminate\Support\Facades\Auth;

function permission($permission)
{
    return Auth::guard('admin')->user()->hasAnyPermission($permission);
}

function getSameWithNewLanguage($lang)
{
    $path = request()->path();
    for ($char = 0; strlen($path); $char++) {
        if ($path[$char] !== "/")
            $path[$char] = ' ';
        else
            break;
    }
    $path = trim($path, " /");
    return "/" . $lang . "/" . $path;
}
