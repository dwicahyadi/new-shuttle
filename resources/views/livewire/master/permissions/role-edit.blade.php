<div>
    @foreach($permissions as $permission)
        <p><input checked="checked" type="checkbox" value="{{$permission->id}}" wire:model="newPermissions.{{$permission->id}}" />  {{ $permission->name }} -- {{ $role->hasPermissionTo($permission->name) }}</p>
    @endforeach

        <button class="btn btn-primary" type="button" wire:click="save">Simpan</button>
</div>
