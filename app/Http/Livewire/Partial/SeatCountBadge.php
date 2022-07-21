<?php

namespace App\Http\Livewire\Partial;

use App\Models\Departure;
use Livewire\Component;

class SeatCountBadge extends Component
{
    public $departure;
    public $ticketsCount;

    protected $listeners = [
        'reservationSaved' => '$refresh',
        'scheduleUpdated' => '$refresh'
    ];
    public function render()
    {
        $this->ticketsCount = $this->departure->schedule->seats - $this->departure->schedule->tickets()->count();
        return view('livewire.partial.seat-count-badge');

    }
}
