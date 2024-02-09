<?php

namespace App\Interfaces\Presenters\Web\Admin;

use App\Entities\Web\Admin\PermissionEntity;
use App\Entities\Web\Admin\RoleEntity;

class RolePresenter
{
    public function presentAllRole($roles)
    {
        $formattedRole = [];

        foreach ($roles as $role) {
            $formattedRole[] = $this->formatRole($role);
        }
        return $formattedRole;

    }

    protected function formatRole(RoleEntity $role)
    {
        $permissions = $role->getPermission();
        $permissionRole=[];
        foreach ($permissions as $permission) {
            $permissionRole[] = $this->formatPermissionForRole($permission);
        }

        return [
            'id' => $role->getId(),
            'name' => $role->getName(),
            'name_i18n' => $role->getNameI18n(),
            'guard_name' => $role->getGuardName(),
            'permissions'=>$permissionRole,
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