<div>
    <form wire:submit.prevent="save">
        <input type="text" name="phone" placeholder="phone" class="mb-1 form-control form-control-sm" autocomplete="off"
        wire:model="phone">
        <input type="text" name="name" placeholder="name" class="mb-1 form-control form-control-sm"
               wire:model="name">
        <select class="form-control form-control-sm mb-2" wire:model="discount_id">
            <option value="" >UMUM</option>

            @forelse($discounts as $discount_)
                <option value="{{ $discount_->id }}">{{ $discount_->name}}</option>
            @empty

            @endforelse

        </select>
        <select class="form-control form-control-sm mb-2" wire:model="departure_point_id">
            @foreach($points as $point)
                <option value="{{ $point->id }}">{{ $point->name }}</option>
            @endforeach
        </select>
        <div class="d-flex justify-content-end">
            <button class="btn btn-sm btn-primary mr-1">Simpan</button>
        </div>
    </form>
</div>
