<?php

namespace App\Interfaces\Gateways\Web\Admin;


interface AdminRepositoryInterface
{
    public function getAllAdmins();

    public function getAdminById($adminId);

    public function createAdmin(array $adminData, array $imageData);

    public function updateAdmin($role, array $adminData);

    public function deleteAdmin($adminId);
}
