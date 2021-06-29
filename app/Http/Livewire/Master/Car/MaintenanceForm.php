<?php

namespace App\Http\Livewire\Master\Car;

use App\Models\Car;
use App\Models\CarMaintenanceHistory;
use Livewire\Component;

class MaintenanceForm extends Component
{
    public Car $car;
    public int $car_id;
    public string $date = '';
    public string $next_maintenance_date = '';
    public string $note = '';

    protected $rules = [
      'car_id'=> 'required',
      'date'=> 'required',
      'next_maintenance_date'=> 'required',
      'note'=> 'required',
    ];

    public function mount($car_id = 0)
    {
        $this->car = Car::find($car_id);

    }

    public function render()
    {
        return view('livewire.master.car.maintenance-form');
    }

    public function save()
    {
        $this->validate();
        CarMaintenanceHistory::create([
           'car_id' => $this->car_id,
           'date' => $this->date,
           'note' => $this->note,
           'next_maintenance_date' => $this->next_maintenance_date,
        ]);

        $this->reset(['date','note','next_maintenance_date']);
        $this->emit('saved');
    }
}
