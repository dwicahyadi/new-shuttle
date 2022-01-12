<?php

namespace App\Http\Livewire\Reservation\Package;

use App\Models\Departure;
use App\Models\Package;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NewForm extends Component
{
    public const FIRST_KILO_PRICE = 35000;
    public const NEXT_KILO_PRICE = 5000;

    public ?Departure $departure = null;
    public int $departure_point_id = 0;
    public string $sender_name = '';
    public string $sender_phone = '';
    public string $receiver_name = '';
    public string $receiver_phone = '';
    public  $weight = 1;
    public int $piece = 1;
    public string $type = '';
    public string $content = '';
    public int $total = self::FIRST_KILO_PRICE;


    protected $listeners =  [
        'setDeparture',
    ];

    public function render()
    {
        return view('livewire.reservation.package.new-form');
    }

    public function setDeparture(Departure $departure)
    {
        $this->departure = $departure;
        $this->departure_point_id = $departure->departure_point_id;
        $this->total = self::FIRST_KILO_PRICE;
    }

    public function save()
    {
        $package = Package::create([
            'departure_id' => $this->departure->id,
            'departure_point_id'=> $this->departure_point_id,
            'sender_name' => $this->sender_name,
            'sender_phone' => $this->sender_phone,
            'receiver_name' => $this->receiver_name,
            'receiver_phone' => $this->receiver_phone,
            'weight' => $this->weight,
            'piece' => $this->piece,
            'type' => $this->type,
            'content' => $this->content,
            'status' => 'transit',
            'payment_by' => Auth::id(),
            'payment_at' => Carbon::now(),
            'settlement_id' => null,
            'price' => $this->total
        ]);
        $this->emit('updatePackageBill');
        $this->emit('packagedSaved');

        $this->reset(['departure_point_id',
            'sender_name',
            'sender_phone',
            'receiver_name',
            'receiver_phone',
            'weight',
            'piece',
            'type',
            'content',]);

    }

    public function updatedWeight($value)
    {
        if($value > 1)
        {
            $next_kilo = round($value) - 1;
            $this->total = self::FIRST_KILO_PRICE + (self::NEXT_KILO_PRICE * $next_kilo);
        }else{
            $this->total = self::FIRST_KILO_PRICE;
        }
    }

}
