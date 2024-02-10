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
        return $this->adminRepository->getAdminById($admin);
    }

    public function createAdmin($request)
    {
        return $this->adminRepository->createAdmin(
            [
                'name' => $request['name'],
                'email' =>  $request['email'],
                'password' => $request['password'],
            ],
            ['image' => $request['image']]
        );
    }

    public function updateAdmin($permission, $request)
    {
        $translator = ['en' => $request['name_en'], 'ar' => $request['name_ar']];

        return $this->adminRepository->updateAdmin($permission, [
            'name' => $request['name_en'],
            'name_i18n' => $translator,
            'guard_name' => $request['guard'],
        ]);
    }

    public function deleteAdmin($permissionId)
    {

        return $this->adminRepository->deleteAdmin($permissionId);
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
