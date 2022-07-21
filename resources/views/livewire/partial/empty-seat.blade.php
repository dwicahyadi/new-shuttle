<div>
    <div class="border p-2 rounded @if($selected) border-primary shadow @endif">
        <div class="empty-seat-card">
            <div class="d-flex justify-content-between">
                <h4>{{ $seatNumber }}</h4>
                @if($selected)
                    <button type="button" class="btn btn-sm btn-danger" wire:click="pickSeats">Tutup</button>
                @else

                    <button class="btn btn-sm btn-primary"wire:click="pickSeats" ><i class="fas fa-user-plus"></i> Pilih</button>
                 @endif
            </div>


        </div>
    </div>
</div>
