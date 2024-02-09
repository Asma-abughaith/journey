<?php

namespace App\Http\Controllers\Web\Admin\Ajax;

use App\Http\Controllers\Controller;
use App\UseCases\Web\Admin\PermissionUseCase;
use App\Interfaces\Presenters\Web\Admin\PermissionPresenter;

class AjaxRoleController extends Controller
{
    protected $permissionPresenter;
    protected $permissionUseCase;

    public function __construct(PermissionPresenter $permissionPresenter, PermissionUseCase $permissionUseCase)
    {
        $this->permissionPresenter = $permissionPresenter;
        $this->permissionUseCase = $permissionUseCase;
    }

    public function index($guard_name)
    {
        $allPermissions = $this->permissionUseCase->allPermissionsBasedGuardName($guard_name);
        return  $this->permissionPresenter->presentAllPermissionsForRolesAjax($allPermissions);
    }
}