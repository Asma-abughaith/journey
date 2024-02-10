<?php

namespace App\Interfaces\Gateways\Web\Admin;


interface AdminRepositoryInterface
{
    public function getAllAdmins();

    public function getAdminById($adminId);

    public function getAdmin($admin);

    public function createAdmin(array $adminData, array $imageData, $role);

    public function updateAdmin($admin, array $adminData, array $imageData, $role);

    public function deleteAdmin($adminId);
}
