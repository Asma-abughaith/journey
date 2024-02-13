<?php

namespace App\UseCases\Web\Admin;

use App\Entities\Web\Admin\PermissionEntity;
use App\Interfaces\Gateways\Web\Admin\AdminRepositoryInterface;

class AdminUseCase
{
    protected $adminRepository;

    public function __construct(AdminRepositoryInterface $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function allAdmins()
    {
        return $this->adminRepository->getAllAdmins();
    }

    public function getAdmin($admin)
    {
        return $this->adminRepository->getAdmin($admin);
    }

    public function getAdminById($adminId)
    {
        return $this->adminRepository->getAdminById($adminId);
    }

    public function createAdmin($request)
    {
        return $this->adminRepository->createAdmin(
            [
                'name' => $request['name'],
                'email' =>  $request['email'],
                'password' => $request['password'],
            ],
            ['image' => isset($request['image']) ? isset($request['image']) : null],
            $request['role']
        );
    }

    public function updateAdmin($admin, $request)
    {
        return $this->adminRepository->updateAdmin(
            $admin,
            [
                'name' => $request['name'],
                'email' =>  $request['email'],
            ],
            ['image' => isset($request['image']) ? isset($request['image']) : null],
            $request['role']
        );
    }

    public function deleteAdmin($admin)
    {

        return $this->adminRepository->deleteAdmin($admin);
    }

    //all method for use case
    public function execute(PermissionEntity $permission)
    {
        return $this->adminRepository->createAdmin([
            'name' => $permission->getName(),
            'name_i18n' => $permission->getNameI18n(),
            'guard_name' => $permission->getGuardName(),
        ]);
    }
}
