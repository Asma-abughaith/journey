<?php

namespace App\UseCases\Web\Admin;

use App\Entities\Web\Admin\PermissionEntity;
use App\Interfaces\Gateways\Web\Admin\RoleRepositoryInterface;

class RoleUseCase
{
    protected $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function allRoles(){
        return $this->roleRepository->getAllRoles();

    }

    public function getRole($roleId){
        return $this->roleRepository->getRoleById($roleId);

    }

    public function createRole($request){
        $translator = ['en' => $request['name_en'], 'ar' => $request['name_ar']];

        return $this->roleRepository->createRole([
            'name' => $request['name_en'],
            'name_i18n' => $translator,
            'guard_name'=>$request['guard'],
            'permissions'=>$request['permissions'],
        ]);
    }

    public function updateRole( $role, $request)
    {
        $translator = ['en' => $request['name_en'], 'ar' => $request['name_ar']];

        return $this->roleRepository->updateRole($role, [
            'name' => $request['name_en'],
            'name_i18n' => $translator,
            'guard_name'=>$request['guard'],
            'permissions'=>$request['permissions'],
        ]);
    }

    public function deleteRole( $role)
    {

        return $this->roleRepository->deleteRole($role);
    }
    //all method for use case
//    public function execute(PermissionEntity $permission)
//    {
//        return $this->permissionRepository->createPermission([
//            'name' => $permission->getName(),
//            'name_i18n' => $permission->getNameI18n(),
//            'guard_name'=>$permission->getGuardName(),
//        ]);
//    }
}
