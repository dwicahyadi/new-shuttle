<div>
    <ul class="list-group p-0 list-group-flush ">
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
                        <small>{{ $departure->date }} {{ $departure->time }}</small><br>
                        <small>{{ $departure->departure_point->city->name }} {{ $departure->departure_point->name }}</small> -
                        <small>{{ $departure->arrival_point->city->name }} {{ $departure->arrival_point->name }}</small>
                    </div>
                    <div>
                        @livewire('partial.seat-count-badge',['departure'=>$departure], key('seatBadge'.$departure->id))
                    </div>
                </div>
            </li>
        @empty
            <h4 class="m-2">Tidak ada keberangaktan</h4>
        @endforelse
    </ul>
</div>
