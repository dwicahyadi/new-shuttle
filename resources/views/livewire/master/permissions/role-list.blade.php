<div>
    <div class="d-flex">
        @forelse($roles as $role)
            @livewire('master.permissions.role-card',['role' => $role], key($role->id));
        @empty

        @endforelse
    </div>
</div>
