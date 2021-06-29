<?php

namespace App\Http\Livewire\Reservation;

use App\Models\Car;
use App\Models\Driver;
use App\Models\Schedule;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class ModalSchedule extends Component
{
    public array $listCosts = [0,230000,710000];
    public Collection $cars;
    public Collection $drivers;
    public ?Schedule $schedule;
    public $car_id, $driver_id, $costs;

    protected $listeners  = [
      'getSchedule'
    ];

    public function mount()
    {
        $this->cars = Car::all();
        $this->drivers = Driver::all();
    }
    public function render()
    {
        return view('livewire.reservation.modal-schedule');
    }

    public function getSchedule(int $schedule_id)
    {
        $this->schedule = Schedule::find($schedule_id);
        $this->car_id = $this->schedule->car_id;
        $this->driver_id = $this->schedule->driver_id;
        $this->costs = $this->schedule->costs;
    }

    public function save()
    {
        $this->schedule->car_id = $this->car_id;
        $this->schedule->driver_id = $this->driver_id;
        $this->schedule->costs = $this->costs;
        $this->schedule->save();
        $this->emit('scheduleUpdated');
        session()->flash('message', 'Jadwal diupdate!');
    }
}
