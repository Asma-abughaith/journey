<?php

namespace App\Interfaces\Gateways\Web\Admin;


interface AdminRepositoryInterface
{
    public function getAllRoles();

    public function getRoleById($roleId);

    public function createRole(array $roleData);

    public function updateRole($role, array $roleData);

    public function deleteRole($roleId);
}
