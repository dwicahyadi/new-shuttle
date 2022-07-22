<?php

namespace App\Http\Livewire\Master\Permissions;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class RoleList extends Component
{
    public function render()
    {
        $roles = Role::all();
        return view('livewire.master.permissions.role-list', compact('roles'));
    }
}
