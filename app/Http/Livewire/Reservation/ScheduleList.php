<?php

namespace App\Http\Livewire\Reservation;

use App\Models\Departure;
use Livewire\Component;

class ScheduleList extends Component
{
    public $departures = [];
    public $selectedId;
    public $onlyFilled;

    public $date, $departurePointId, $arrivalPointId;

    protected $queryString = ['date', 'departurePointId','arrivalPointId'];

    protected $listeners = [
        'findDepartures'
    ];


    public function mount()
    {
        $this->findDepartures($this->date,$this->departurePointId, $this->arrivalPointId);
    }
    public function render()
    {
        return view('livewire.reservation.schedule-list');
    }

    public function findDepartures($date, $departurePointId = 0, $arrivalPointId = 0)
    {
        $builder = Departure::query()
            ->with(['schedule'])->withCount('tickets')->whereDate('date', $date)
            ->where('is_open', 1)
            ->orderBy('time','asc');

        $builder->when($arrivalPointId, function ($q) use ($arrivalPointId) {
            $q->where('arrival_point_id', $arrivalPointId);
        });

        $builder->when($departurePointId, function ($q) use ($departurePointId) {
            $q->where('departure_point_id', $departurePointId);
        });

        $this->departures = $builder->get();
    }

    public function select($id)
    {
        $this->selectedId = $id;
        $departure = Departure::with(['schedule', 'tickets', 'departure_point', 'arrival_point', 'city'])
            ->where('id', $id)->first();
        $this->emit('setDeparture',$departure);
    }
}
