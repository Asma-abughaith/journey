<?php

namespace App\Repositories\Web\Admin;

use App\Entities\Web\Admin\AdminEntity;
use App\Interfaces\Gateways\Web\Admin\AdminRepositoryInterface;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;


class EloquentAdminRepository implements AdminRepositoryInterface
{
    public function getAllAdmins()
    {
        $eloquentAdmins = Admin::all();
        $admins = [];

        foreach ($eloquentAdmins as $eloquentAdmin) {
            $admins[] = $this->convertToEntity($eloquentAdmin);
        }

        return $admins;
    }

    public function getAdminById($permissionId)
    {
        $eloquentPermission = Permission::find($permissionId);

        return $eloquentPermission ? $this->convertToEntity($eloquentPermission) : null;
    }

    public function createAdmin(array $adminData, array $imageData)
    {
        $eloquentPermission = Admin::create($adminData);
        $eloquentPermission->addMediaFromRequest('image')->toMediaCollection('admin_profile');
        return $this->convertToEntity($eloquentPermission);
    }

    public function updateAdmin($permission, array $permissionData)
    {
        if ($permission) {
            $permission->update($permissionData);
            $permission->setTranslations('name_i18n', $permissionData['name_i18n']);
        }
        return $this->convertToEntity($permission);
    }

    public function deleteAdmin($permissionId)
    {

        if ($permissionId) {
            DB::table('permissions')->where('id', $permissionId)->delete();
        }
        return;
    }

    protected function convertToEntity(Admin $eloquentAdmin)
    {
        $admin = new AdminEntity();
        $admin->setId($eloquentAdmin->id);
        $admin->setName($eloquentAdmin->name);
        $admin->setEmail($eloquentAdmin->email);
        $admin->setLang($eloquentAdmin->lang);
        $admin->setImage($eloquentAdmin->getFirstMediaUrl('admin_profile', 'image'));
        return $admin;
    }
}