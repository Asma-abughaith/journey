<?php

namespace App\Repositories\Web\Admin;

use App\Entities\Web\Admin\PermissionEntity;
use App\Interfaces\Gateways\Web\Admin\PermissionRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;


class EloquentPermissionRepository implements PermissionRepositoryInterface
{
    public function getAllPermissions()
    {
        $eloquentPermissions = Permission::all();
        $permissions = [];

        foreach ($eloquentPermissions as $eloquentPermission) {
            $permissions[] = $this->convertToEntity($eloquentPermission);
        }

        return $permissions;
    }

    public function getPermissionById($permissionId)
    {
        $eloquentPermission = Permission::find($permissionId);

        return $eloquentPermission ? $this->convertToEntity($eloquentPermission) : null;
    }

    public function getPermission($permission)
    {

        return $permission ? $this->convertToEntity($permission) : null;
    }

    public function createPermission(array $permissionData)
    {
        $eloquentPermission = Permission::create($permissionData);
        $eloquentPermission->setTranslations('name_i18n', $permissionData['name_i18n']);

        return $this->convertToEntity($eloquentPermission);
    }

    public function updatePermission($permission, array $permissionData)
    {
        if ($permission) {
            $permission->update($permissionData);
            $permission->setTranslations('name_i18n', $permissionData['name_i18n']);
        }

        return $this->convertToEntity($permission);
    }

    public function deletePermission($permissionId)
    {

        if ($permissionId) {
            DB::table('permissions')->where('id',$permissionId)->delete();
        }
        return ;
    }

    protected function convertToEntity(Permission $eloquentPermission)
    {
        $permission = new PermissionEntity();
        $permission->setId($eloquentPermission->id);
        $permission->setName($eloquentPermission->name);
        $permission->setNameI18n($eloquentPermission->name_i18n);
        $permission->setGuardName($eloquentPermission->guard_name);
        return $permission;
    }
}
