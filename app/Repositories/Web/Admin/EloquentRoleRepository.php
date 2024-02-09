<?php

namespace App\Repositories\Web\Admin;

use App\Entities\Web\Admin\PermissionEntity;
use App\Entities\Web\Admin\RoleEntity;
use App\Interfaces\Gateways\Web\Admin\RoleRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class EloquentRoleRepository implements RoleRepositoryInterface
{
    public function getAllRoles()
    {
        $eloquentRoles = Role::all();
        $roles = [];

        foreach ($eloquentRoles as $eloquentRole) {
            $roles[] = $this->convertToEntity($eloquentRole);
        }

        return $roles;
    }

    public function getRoleById($roleId)
    {
        $eloquentRole = Role::find($roleId);

        return $eloquentRole ? $this->convertToEntity($eloquentRole) : null;
    }

    public function getRole($role)
    {
        return $role ? $this->convertToEntity($role) : null;
    }

    public function createRole(array $roleData)
    {
        $eloquentRole = Role::create($roleData);
        $eloquentRole->setTranslations('name_i18n', $roleData['name_i18n']);
        $eloquentRole->syncPermissions($roleData['permissions']);
        return $this->convertToEntity($eloquentRole);
    }

    public function updateRole($role, array $roleData)
    {
        if ($role) {
            $role->update($roleData);
            $role->setTranslations('name_i18n', $roleData['name_i18n']);
        }

        return $this->convertToEntity($role);
    }

    public function deleteRole($roleId)
    {

        if ($roleId) {
            DB::table('permissions')->where('id', $roleId)->delete();
        }
        return;
    }

    protected function convertToEntity(Role $eloquentRole)
    {
        $role = new RoleEntity();
        $role->setId($eloquentRole->id);
        $role->setName($eloquentRole->name);
        $role->setNameI18n($eloquentRole->name_i18n);
        $role->setGuardName($eloquentRole->guard_name);
        return $role;
    }
}
