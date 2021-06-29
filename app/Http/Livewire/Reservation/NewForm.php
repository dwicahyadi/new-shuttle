<?php

namespace App\Http\Livewire\Reservation;

use App\Models\Customer;
use App\Models\Departure;
use App\Models\Discount;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NewForm extends Component
{
    const CODE_PASSENGER_RESERVATION = 'PSG';
    public Departure $departure;
    public Collection $discounts;
    public int $ticketDeparturePointId = 0;
    public ?Customer $customer = null;
    public ?array $ticketDiscounts = [];
    public bool $isMember = false;
    public bool $isMultiRoute = false;
    public ?string $expire = null;
    public ?string $note = '';
    public array $selectedSeats = [];
    public int $total = 0;
    public int $uniqueNumber = 0;

    protected $listeners = [
        'setDeparture',
        'setCustomer',
        'changeCustomer',
        'pickSeats'
    ];


    public function mount()
    {
        $this->discounts = Discount::where('active', 1)->get();
    }

    public function render()
    {
        return view('livewire.reservation.new-form');
    }

    public function setDeparture(Departure $departure)
    {
        $this->departure = $departure;
        $this->ticketDeparturePointId = $departure->departure_point_id;
        $this->selectedSeats = [];
        $this->total = 0;
    }

    public function setCustomer(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function changeCustomer()
    {
        $this->customer = null;
    }

    public function pickSeats($seatNumber)
    {
        if (in_array($seatNumber, $this->selectedSeats)) {
            $key = array_search($seatNumber, $this->selectedSeats);
            unset($this->selectedSeats[$key]);
        } else {
            $this->selectedSeats[] = $seatNumber;
        }
        $this->sumPrice();
    }

    public function sumPrice()
    {
        $total_ticket_prices = $this->departure->price * count($this->selectedSeats);
        $total_ticket_discount = $this->sumDiscountAmount();
        $this->total = $total_ticket_prices - $total_ticket_discount;
    }

    private function sumDiscountAmount() : int
    {
        $sum = 0;
        if ($this->ticketDiscounts)
        {
            foreach ($this->ticketDiscounts as $discount)
            {
                $obj = (object) json_decode($discount);
                $sum += $obj->amount ?? 0;
            }
        }
        return $sum;
    }

    private function createNewReservation()
    {
        $reservation = new \App\Models\Reservation();
        $reservation->user_id = Auth::id();
        $reservation->customer_id = $this->customer->id;
        $reservation->code = self::CODE_PASSENGER_RESERVATION . Auth::id() . date('ymdHis');
        $reservation->expired_at = $this->expire ?? null;
        if($this->uniqueNumber) $reservation->transfer_amount = $this->total + $this->uniqueNumber;
        $reservation->note = $this->note ?? null;
        $reservation->save();
        return $reservation;
    }

    private function createTicket(Reservation $reservation): void
    {
        foreach ($this->selectedSeats as $seat) {
            $ticket = new \App\Models\Ticket();
            $discount = (object) json_decode($this->ticketDiscounts[$seat] ?? '');

            $ticket->reservation_id = $reservation->id;
            $ticket->phone = $this->customer->phone;
            $ticket->name = $this->customer->name;
            $ticket->seat = $seat;
            $ticket->discount_id = $discount->id ?? null;
            $ticket->discount_name = $discount->name ?? null;
            $ticket->discount_amount = $discount->amount ?? 0;
            $ticket->price = $this->departure->price - ($discount->amount ?? 0);
            $ticket->departure_id = $this->departure->id;
            $ticket->reservation_by = Auth::id();
            $ticket->reservation_at = now();
            $ticket->status = 'unpaid';
            $ticket->count_print = 0;
            $ticket->departure_point_id = $this->ticketDeparturePointId ?? $this->departure->departure_point_id;
            $ticket->date = Carbon::createFromFormat('d M Y',$this->departure->date)->format('Y-m-d');
            $ticket->is_multiroute = $this->isMultiRoute;
            $ticket->save();
        }
    }

    private function payment(Reservation $reservation, string $method = 'CASH PAYMENT')
    {
        $reservation->update(['expired_at'=> null,'is_expired'=>false]);
        $reservation->tickets()->update(
            [
                'status' => 'paid',
                'payment_method' => $method,
                'payment_at' => now(),
                'payment_by' => Auth::id(),
            ]
        );
        activity('reservation_log')->performedOn($reservation)->causedBy(Auth::user())->log('payment');
        $this->emit('updateBill');
        $reservation->customer->updateCustomerCountReservationFinish();
    }

    public function save()
    {
        $reservation = $this->createNewReservation();
        $this->createTicket($reservation);
        activity('reservation_log')
            ->performedOn($reservation)
            ->causedBy(Auth::user())->log('new reservation');
        $this->emit('reservationSaved');
        $this->reset([
            'customer',
            'ticketDiscounts',
            'isMember',
            'isMultiRoute',
            'expire',
            'note',
            'selectedSeats',
            'total',
            'uniqueNumber',
        ]);
    }

    public function saveAndPayment()
    {
        $reservation = $this->createNewReservation();
        $this->createTicket($reservation);
        activity('reservation_log')
            ->performedOn($reservation)
            ->causedBy(Auth::user())->log('new reservation');

        $this->payment($reservation);
        $this->emit('reservationSaved');
        $this->reset([
            'customer',
            'ticketDiscounts',
            'isMember',
            'isMultiRoute',
            'expire',
            'note',
            'selectedSeats',
            'total',
            'uniqueNumber',
        ]);
    }


}
