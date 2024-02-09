<?php

namespace App\Livewire\Role;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class CreateRole extends Component
{
    public $name_en, $name_ar, $guard, $permissions = [];

    public function mount()
    {
    }

    public function guardChange()
    {
        $this->permissions = Permission::where('guard_name', $this->guard)->get()->pluck('name')->toArray();
    }

    public function submit()
    {
    }

    public function render()
    {
        return view('livewire.role.create-role', [
            'permissions' => $this->permissions // You might want to fetch all permissions here if needed.
        ]);
    }
}
