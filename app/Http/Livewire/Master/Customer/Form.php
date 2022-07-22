<?php

namespace App\Http\Livewire\Master\Customer;

use App\Models\Car;
use Livewire\Component;

class Form extends Component
{
    public $customer;
    public $customer_id, $code, $license_number, $kilometers, $active;

    public function mount($id = 0)
    {
        if($id){
            $this->customer = Car::find($id);
            $this->car_id = $this->customer->id;
            $this->code = $this->customer->code;
            $this->license_number = $this->customer->license_number;
            $this->kilometers = $this->customer->kilometers;
            $this->active = $this->customer->active;
        }else{
            $this->customer = new Car();
        }
    }

    public function render()
    {
        return view('livewire.master.customer.form');
    }

    public function save()
    {
        $this->customer->code = $this->code;
        $this->customer->license_number = $this->license_number;
        $this->customer->kilometers = $this->kilometers;
        $this->customer->active = $this->active ?? true;
        $this->customer->save();
        if (!$this->car_id)
            return redirect()->route('master.car.index');
    }
}
