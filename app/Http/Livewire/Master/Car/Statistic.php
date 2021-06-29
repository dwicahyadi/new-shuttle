<?php

namespace App\Http\Livewire\Master\Car;

use App\Models\Car;
use Livewire\Component;

class Statistic extends Component
{
    public $car_id;

    public function render()
    {
        $car = Car::find($this->car_id);
        $car_history = $car->history()
            ->whereMonth('date',date('m'))
            ->whereYear('date',date('Y'))->get();
        $rit = $car_history->count();
        $costs = $car_history->sum('costs');
        return view('livewire.master.car.statistic', compact(['rit','costs']));
    }
}
