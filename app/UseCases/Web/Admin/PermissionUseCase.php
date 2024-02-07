<?php

namespace App\UseCases\Web\Admin;

use App\Entities\Web\Admin\PermissionEntity;
use App\Interfaces\Gateways\Web\Admin\PermissionRepositoryInterface;

class PermissionUseCase
{
    protected $permissionRepository;

    public function __construct(PermissionRepositoryInterface $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    public function allPermissions(){
        return $this->permissionRepository->getAllPermissions();

    }

    public function getPermission($permission){
        return $this->permissionRepository->getPermission($permission);

    }

    public function createPermission($request){
        $translator = ['en' => $request['name_en'], 'ar' => $request['name_ar']];

        return $this->permissionRepository->createPermission([
            'name' => $request['name_en'],
            'name_i18n' => $translator,
            'guard_name'=>$request['guard'],
        ]);
    }

    public function updatePermission( $permission, $request)
    {
        $translator = ['en' => $request['name_en'], 'ar' => $request['name_ar']];

        return $this->permissionRepository->updatePermission($permission, [
            'name' => $request['name_en'],
            'name_i18n' => $translator,
            'guard_name'=>$request['guard'],
        ]);
    }

    public function deletePermission( $permissionId)
    {

        return $this->permissionRepository->deletePermission($permissionId);
    }
    //all method for use case
    public function execute(PermissionEntity $permission)
    {
        return $this->permissionRepository->createPermission([
            'name' => $permission->getName(),
            'name_i18n' => $permission->getNameI18n(),
            'guard_name'=>$permission->getGuardName(),
        ]);
    }
}
