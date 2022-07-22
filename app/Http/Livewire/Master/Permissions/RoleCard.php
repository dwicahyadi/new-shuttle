<?php

namespace App\Http\Livewire\Master\Permissions;

use Livewire\Component;

class RoleCard extends Component
{
    public $role;
    public $is_edit = false;

    public function render()
    {
        return view('livewire.master.permissions.role-card');
    }

    public function toggleEdit()
    {
        $this->is_edit = !$this->is_edit;
    }
}
