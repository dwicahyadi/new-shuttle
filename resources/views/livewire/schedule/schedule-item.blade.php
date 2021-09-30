<div>
    <div class="card shadow-sm mb-2">
        <div class="card-body d-flex justify-content-between">
            @if($departure->is_open)
                <h4>{{ substr($departure->time, 0,5) }}</h4>
            @else
                <h4><s>{{ substr($departure->time, 0,5) }}</s></h4>
            @endif


            @if($departure->is_open)
                <button type="button" class="btn btn-danger" wire:click="toggleOpen">CLOSE JADWAL</button>
            @else
                <button type="button" class="btn btn-success" wire:click="toggleOpen">OPEN JADWAL</button>
            @endif

        </div>
    </div>
</div>
