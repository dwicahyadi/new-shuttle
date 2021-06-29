<?php

namespace App\Http\Livewire\Master\Car;

use App\Models\Car;
use Livewire\Component;

class Form extends Component
{
    public $car;
    public $car_id, $code, $license_number, $kilometers, $active;

    public function mount($id = 0)
    {
        if($id){
            $this->car = Car::find($id);
            $this->car_id = $this->car->id;
            $this->code = $this->car->code;
            $this->license_number = $this->car->license_number;
            $this->kilometers = $this->car->kilometers;
            $this->active = $this->car->active;
        }else{
            $this->car = new Car();
        }
    }

    public function render()
    {
        return view('livewire.master.car.form');
    }

    public function save()
    {
        $this->car->code = $this->code;
        $this->car->license_number = $this->license_number;
        $this->car->kilometers = $this->kilometers;
        $this->car->active = $this->active ?? true;
        $this->car->save();
        if (!$this->car_id)
            return redirect()->route('master.car.index');
    }
}
