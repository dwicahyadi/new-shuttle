<div>
    @forelse($departures as $departure)
        @livewire('schedule.schedule-item',['departure'=> $departure], key('departure'.$departure->id))
    @empty
        <h4>Tidak ada keberangaktan</h4>
    @endforelse
</div>
