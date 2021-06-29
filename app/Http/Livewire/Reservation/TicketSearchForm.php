<?php

namespace App\Http\Livewire\Reservation;

use Livewire\Component;

class TicketSearchForm extends Component
{
    public $phone;

    public function render()
    {
        return view('livewire.reservation.ticket-search-form');
    }
}
