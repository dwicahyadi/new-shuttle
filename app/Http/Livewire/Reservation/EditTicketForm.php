<?php

namespace App\Http\Livewire\Reservation;

use App\Models\Discount;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class EditTicketForm extends Component
{
    public Ticket $ticket;
    public Collection $discounts;
    public Collection $points;
    public string $name = '';
    public string $phone = '';
    public ?string $discount_id = null;
    public int $departure_point_id = 0;
    public int $price = 0;


    public function mount (Ticket $ticket)
    {
        $this->ticket = $ticket;
        $this->name = $ticket->name;
        $this->phone = $ticket->phone;
        $this->discount_id = $ticket->discount_id ?? null;
        $this->departure_point_id = $ticket->departure_point_id;

        $this->discounts = Discount::where('active', 1)->get();

        $this->points = $ticket->departure->city->points;
        $this->price = $ticket->departure->price;

    }

    public function render()
    {
        return view('livewire.reservation.edit-ticket-form');
    }

    public function save()
    {
        $discount = Discount::find((int) $this->discount_id);

        $this->ticket->name = $this->name;
        $this->ticket->phone = $this->phone;
        $this->ticket->discount_id = $discount->id ?? null;
        $this->ticket->discount_name = $discount->name ?? null;
        $this->ticket->discount_amount = $discount->amount ?? null;
        $this->ticket->price = $this->price - ($discount->amount ?? 0);
        $this->ticket->departure_point_id = $this->departure_point_id;
        $this->ticket->save();
        $this->emitUp('reload');
        $this->emitUp('toggleEdit');
    }
}
