<?php

namespace App\Http\Livewire\Schedule;

use App\Models\Departure;
use Livewire\Component;

class ScheduleList extends Component
{
    public $departures = [];

    protected $listeners = [
        'findDepartures'
    ];


    public function render()
    {
        return view('livewire.schedule.schedule-list');
    }
    public function findDepartures($date, $departurePointId, $arrivalPointId)
    {
        $this->selectedId = 0;
        $this->departures = Departure::with(['schedule'])->whereDate('date', $date)
            ->where('arrival_point_id', $arrivalPointId)
            ->where('departure_point_id', $departurePointId)
            ->orderBy('time','asc')
            ->get();
    }

}
