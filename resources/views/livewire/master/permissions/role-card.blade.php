<div>
    <div class="card shadow mx-4 my-4" style="width: 15rem;">
        <div class="card-header d-flex">
            <strong class="flex-fill">{{ $role->name }}</strong>
            <button type="button" wire:click="toggleEdit" class="btn btn-sm btn-primary mr-0"><i class="fa fa-edit"></i></button>
        </div>
        <div class="card-body">
            @if($is_edit)
                Show Form
                @livewire('master.permissions.role-edit',['role' => $role], key('edit-'.$role->id))
            @else
                @forelse($role->permissions as $permission)
                    {{ $permission->name }};

                @empty
                    Tidak punya hak akses
                @endforelse
            @endif
        </div>
    </div>
</div>
