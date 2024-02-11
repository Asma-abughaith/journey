<?php

namespace App\Repositories\Web\Setting;

use App\Entities\Web\Admin\AdminEntity;
use App\Interfaces\Gateways\Web\Admin\AdminRepositoryInterface;
use App\Interfaces\Gateways\Web\Setting\LanguageRepositoryInterface;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;


class EloquentLanguageRepository implements LanguageRepositoryInterface
{
    public function setLanguage($langData){
        $admin = Auth::guard('admin')->user();
        $admin->update($langData);
        return;
    }
}
