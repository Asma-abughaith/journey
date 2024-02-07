<?php

namespace App\Interfaces\Gateways\Web\Admin;


interface PermissionRepositoryInterface
{
    public function getAllPermissions();

    public function getPermissionById($permissionId);

    public function createPermission(array $permissionData);

    public function updatePermission($permissionId, array $permissionData);

    public function deletePermission($permissionId);
}
