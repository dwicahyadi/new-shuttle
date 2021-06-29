<?php

namespace App\Http\Livewire\Partial;

use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FilledSeat extends Component
{
    public int $seatNumber;
    public bool $isEdit = false;
    public Ticket $ticket;

    protected $listeners = [
        'reload',
        'toggleEdit'
    ];

    public function render()
    {
        return view('livewire.partial.filled-seat');
    }

    public function toggleEdit()
    {
        $this->isEdit = !$this->isEdit;
    }

    public function reload()
    {
        $this->ticket = Ticket::find($this->ticket->id);
    }
    public function cancelTicket()
    {
        $this->ticket->is_cancel = true;
        $this->ticket->status = 'cancel';
        $this->ticket->save();
        activity('reservation_log')->performedOn($this->ticket->reservation)->causedBy(Auth::user())->log('cancel ticket seat '.$this->seatNumber);
        $this->emit('reservationSaved');

    }

}
