<?php

namespace App\Http\Livewire\Master\Permissions;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleEdit extends Component
{
    public Role $role;
    public $newPermissions = [];

    public function render()
    {
        $permissions = Permission::all();
        return view('livewire.master.permissions.role-edit', compact('permissions'));
    }

    public function save()
    {
        $this->role->syncPermissions($this->newPermissions);
    }


}
