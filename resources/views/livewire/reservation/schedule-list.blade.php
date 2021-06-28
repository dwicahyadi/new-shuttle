<div>
    <ul class="list-group p-0 list-group-flush">
        @forelse($departures as $departure)
            @if($onlyFilled)
                @continue(!$departure->tickets_count)
            @endif

            <li class="list-group-item list-group-item-action p-2 @if($selectedId == $departure->id) rounded bg-primary text-white @endif" wire:click="select('{{$departure->id}}')" wire:key="departure-{{$departure->id}}">
                <div class="d-flex align-items-center">
                    <div class="mr-2">
                        <i class="mdi mdi-clock-outline mdi-24px"></i>
                    </div>
                    <div class="flex-fill">
                        <strong class="clearfix">{{ substr($departure->time, 0,5) }}</strong>
                    </div>
                    <div>
                        <label class="badge badge-success">{{ $departure->schedule->seats - $departure->tickets_count }}</label>
                    </div>
                </div>
            </li>
        @empty
            <h4>Tidak ada keberangaktan</h4>
        @endforelse
    </ul>
</div>
