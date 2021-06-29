<?php

namespace App\Http\Livewire\Reservation;

use App\Models\Departure;
use Livewire\Component;

class ScheduleList extends Component
{
    public $departures = [];
    public $selectedId = 0;
    public $onlyFilled;

    protected $listeners = [
      'findDepartures'
    ];


    public function render()
    {
        return view('livewire.reservation.schedule-list');
    }

    public function findDepartures($date, $departurePointId, $arrivalPointId)
    {
        $this->selectedId = 0;
        $this->departures = Departure::with(['schedule'])->withCount('tickets')->whereDate('date', $date)
            ->where('arrival_point_id', $arrivalPointId)
            ->where('departure_point_id', $departurePointId)
            ->where('is_open', 1)
            ->orderBy('time','asc')
            ->get();
    }

    public function select($id)
    {
        $this->selectedId = $id;
        $departure = Departure::with(['schedule', 'tickets', 'departure_point', 'arrival_point', 'city'])
            ->where('id', $id)->first();
        $this->emit('setDeparture',$departure);
    }
}
