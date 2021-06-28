<div>
    <div class="border p-2 rounded @if($selected) border-primary shadow @endif">
        <div class="">
            <div class="d-flex justify-content-between">
                <h4>{{ $seatNumber }}</h4>
                @if($selected)
                    <div>

                    </div>
                @endif
            </div>

            @if($selected)
                <button type="button" class="btn btn-sm btn-outline-danger" wire:click="pickSeats">Tutup</button>
            @else
                <div class="p-4 text-center">
                    <button class="btn btn-sm btn-outline-primary" wire:click="pickSeats"><i class="fas fa-user-plus"></i> Pilih</button>
                </div>
            @endif
        </div>
    </div>
</div>
