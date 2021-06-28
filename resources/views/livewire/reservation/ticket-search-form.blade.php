<div>
    <form class="p-2" wire:submit.prevent="search">
        <div class="form-group">
            <label>Nomor Telepon</label>
            <input type="text" wire:model.lazy="phone" class="form-control">
            @error('pgone')<br>{{ $message }}@enderror
        </div>

        <div class="form-group d-flex">
            <button type="submit" class="btn btn-primary flex-fill"><i class="mdi mdi-account-search-outline"></i> Cari</button>
        </div>
    </form>
</div>
