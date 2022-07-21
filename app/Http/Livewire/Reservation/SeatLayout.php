<?php

namespace App\Http\Livewire\Reservation;

use App\Models\Departure;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;


class SeatLayout extends Component
{
    public int $seatPerRow;
    public Departure $departure;
    public ?Collection $seats;
    public array $selectedSeats = [];
    public int $totalSeats = 10;


    protected $listeners = [
        'setDeparture',
        'reservationSaved' => '$refresh',
        'scheduleUpdated' => '$refresh'
    ];

    public function mount()
    {
        $this->seatPerRow = config('settings.seat_per_row') ?? 3;
    }

    public function render()
    {
        if (isset($this->departure))
        {
            $this->seats = $this->departure->schedule->tickets->keyBy('seat');
            if ($this->departure->schedule->seats  == 8)
                return view('livewire.reservation.8-seats-layout');
        }

        return view('livewire.reservation.seat-layout');

    }

    public function setDeparture(Departure $departure)
    {
        $this->departure = $departure;
    }

    public function unsetDeparture()
    {
        $this->departure = null;
    }

}
