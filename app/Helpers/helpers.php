<?php

use Illuminate\Support\Facades\Auth;

function AdminPermission($permission)
{
    return Auth::guard('admin')->user()->hasAnyPermission($permission);
}

