<?php
// app/Validation/CheckNameEnAndGuardExistRule.php

namespace App\Validation;

use Illuminate\Contracts\Validation\Rule;

use Spatie\Permission\Models\Role;

// Replace YourModel with the appropriate model name

class CheckRoleNameAndGuardExistRule implements Rule
{
    protected $roleId;

    public function __construct($currentPermissionId)
    {
        $this->roleId = $currentPermissionId;
    }
    public function passes($attribute, $value)
    {
        if($this->roleId){
            return Role::where('name', $value)->where('guard_name', request()->input('guard'))->where('id', '!=', $this->roleId)->doesntExist();
        }
        return Role::where('name', $value)->where('guard_name', request()->input('guard'))->doesntExist();


    }

    public function message()
    {
        return 'The combination of name and guard already exists.';
    }
}
