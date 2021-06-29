<?php

namespace App\Http\Livewire\Reservation;

use App\Models\Departure;
use Livewire\Component;

class DepartureInfoCard extends Component
{
    public Departure $departure;

    protected $listeners = [
        'setDeparture',
        'scheduleUpdated' => '$refresh'
    ];

    public function render()
    {
        return view('livewire.reservation.departure-info-card');
    }

    public function setDeparture(Departure $departure)
    {
        $this->departure = $departure;
    }

}
