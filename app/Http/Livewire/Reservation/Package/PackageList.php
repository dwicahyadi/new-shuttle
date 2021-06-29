<?php

namespace App\Http\Livewire\Reservation\Package;

use App\Models\Departure;
use App\Models\Package;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class PackageList extends Component
{
    public ?Departure $departure;
    public ?Collection $packages;

    protected $listeners =  [
        'setDeparture',
        'packagedSaved' => '$refresh'
    ];

    public function render()
    {
        if (isset($this->departure))
        {
            $this->packages = $this->departure->packages;
        }
        return view('livewire.reservation.package.package-list');
    }

    public function setDeparture(Departure $departure)
    {
        $this->departure = $departure;
    }
}
