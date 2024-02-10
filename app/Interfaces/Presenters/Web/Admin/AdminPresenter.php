<?php

namespace App\Interfaces\Presenters\Web\Admin;

use App\Entities\Web\Admin\AdminEntity;
use App\Entities\Web\Admin\PermissionEntity;

class AdminPresenter
{
    public function presentAllAdmins($admins)
    {
        $formattedAdmins = [];

        foreach ($admins as $admin) {
            $formattedAdmins[] = $this->formatAdmin($admin);
        }
        return $formattedAdmins;
    }

    public function presentAllPermissionsForRoles($Permissions)
    {
        $formattedPermissions = [];

        foreach ($Permissions as $Permission) {
            $formattedPermissions[] = $this->formatPermissionForRole($Permission);
        }
        return $formattedPermissions;
    }

    public function presentAllPermissionsForRolesAjax($Permissions)
    {
        $formattedPermissions = [];

        foreach ($Permissions as $Permission) {
            $formattedPermissions[] = $this->formatPermissionForRole($Permission);
        }
        return $formattedPermissions != null ? response()->json(["status" => 200, "data" => [$formattedPermissions]]) : response()->json(["status" => 201,]);
    }

    public function presentPermission($permission)
    {
        return $this->formatAdmin($permission);
    }

    protected function formatAdmin(AdminEntity $admin)
    {
        return [
            'id' => $admin->getId(),
            'name' => $admin->getName(),
            'email' => $admin->getEmail(),
            'lang' => $admin->getLang(),
            'image' => $admin->getImage(),
        ];
    }

    protected function formatPermissionForRole(PermissionEntity $permission)
    {
        return [
            'name' => $permission->getName(),
            'name_i18n' => $permission->getNameI18n(),
        ];
    }
}
