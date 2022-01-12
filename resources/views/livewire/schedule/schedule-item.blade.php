<div>
    <div class="card shadow-sm mb-2">
        <div class="card-body d-flex justify-content-between">
            <div>
                @if($departure->is_open)
                    <h4>{{ substr($departure->time, 0,5) }}</h4>
                @else
                    <h4><s>{{ substr($departure->time, 0,5) }}</s></h4>
                @endif
            </div>


            <div>

                @if($departure->is_open)
                    @livewire('partial.seat-count-badge',['departureId'=>$departure->id], key('seatBadge'.$departure->id))
                    <button type="button" class="btn btn-danger btn-sm" wire:click="toggleOpen">CLOSE JADWAL</button>
                @else
                    <button type="button" class="btn btn-success btn-sm" wire:click="toggleOpen">OPEN JADWAL</button>
                @endif
            </div>

        </div>
    </div>
</div>
