<?php

namespace App\Http\Livewire\Partial;

use App\Models\Departure;
use Livewire\Component;

class SeatCountBadge extends Component
{
    public $departureId;
    public $ticketsCount;

    protected $listeners = [
        'reservationSaved' => '$refresh',
        'scheduleUpdated' => '$refresh'
    ];
    public function render()
    {
        $departure = Departure::with(['schedule'])->withCount('tickets')->find($this->departureId);
        $this->ticketsCount = $departure->schedule->seats - $departure->tickets_count;
        return view('livewire.partial.seat-count-badge');

    }
}
