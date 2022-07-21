<?php

namespace App\Http\Livewire\Reservation;

use App\Models\City;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ScheduleSearchForm extends Component
{
    public $cities, $date, $departurePointId, $arrivalPointId;

    protected $queryString = ['date', 'departurePointId','arrivalPointId'];

    public function mount()
    {
        $this->cities = City::with(['points'])->get();
        $this->date = date('Y-m-d');
        $this->departurePointId = Auth::user()->point_id;
        $this->emit('findDepartures', $this->date, $this->departurePointId, $this->arrivalPointId);

    }

    public function render()
    {
        return view('livewire.reservation.schedule-search-form');
    }

    public function search()
    {
        $this->emit('findDepartures', $this->date, $this->departurePointId, $this->arrivalPointId);
    }
}
