<?php

namespace App\Interfaces\Presenters\Web\Admin;

use App\Entities\Web\Admin\RoleEntity;

class RolePresenter
{
    public function presentAllRole($roles)
    {
        $formattedRole = [];

        foreach ($roles as $role) {
            $formattedRole[] = $this->formatRole($role);
        }
        return $formattedRole;

    }


    public function presentRole($role)
    {
        return $this->formatRole($role);
    }

    protected function formatRole(RoleEntity $role)
    {
        return [
            'id' => $role->getId(),
            'name' => $role->getName(),
            'name_i18n' => $role->getNameI18n(),
            'guard_name' => $role->getGuardName(),
        ];
    }
}
