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

    public function getAdmin($admin)
    {
        return $this->convertToEntity($admin);
    }

    public function getAdminById($permissionId)
    {
        $eloquentPermission = Permission::find($permissionId);

        return $eloquentPermission ? $this->convertToEntity($eloquentPermission) : null;
    }

    public function createAdmin(array $adminData, array $imageData, $role)
    {
        $eloquentAdmin = Admin::create($adminData);
        isset($imageData) ?? $eloquentAdmin->addMediaFromRequest('image')->toMediaCollection('admin_profile');
        if (isset($role)) $eloquentAdmin->assignRole($role);
        return $this->convertToEntity($eloquentAdmin);
    }

    public function updateAdmin($admin, array $adminData, array $imageData, $role)
    {
        $admin->update($adminData);
        if (isset($imageData['image']) && $imageData['image'] != null) {
            $admin->addMediaFromRequest('image')->toMediaCollection('admin_profile');
        }
        $admin->syncRoles($role);
        return $this->convertToEntity($admin);
    }


    public function deleteAdmin($admin)
    {
        if ($admin) {
            $admin->delete();
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
        $admin->setRole($eloquentAdmin->getRoleNames()[0]);
//                $admin->setRole('super admin');

        return $admin;
    }
}
