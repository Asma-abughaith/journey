<?php

namespace App\Interfaces\Presenters\Web\Admin;

use App\Entities\Web\Admin\PermissionEntity;

class PermissionPresenter
{
    public function presentAllPermissions($Permissions)
    {
        $formattedPermissions = [];

        foreach ($Permissions as $Permission) {
            $formattedPermissions[] = $this->formatPermission($Permission);
        }
        return $formattedPermissions;
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
        return $this->formatPermission($permission);
    }

    protected function formatPermission(PermissionEntity $permission)
    {
        return [
            'id' => $permission->getId(),
            'name' => $permission->getName(),
            'name_i18n' => $permission->getNameI18n(),
            'guard_name' => $permission->getGuardName(),
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
