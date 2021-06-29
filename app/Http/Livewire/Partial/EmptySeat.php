<?php

namespace App\Http\Livewire\Partial;

use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class EmptySeat extends Component
{
    public int $seatNumber;
    public bool $selected = false;

    public function render()
    {
        return view('livewire.partial.empty-seat');
    }

    public function toggleSeat()
    {
        $this->selected = !$this->selected;
    }

    public function pickSeats()
    {
        $this->toggleSeat();
        $this->emit('pickSeats', $this->seatNumber);
    }
}
