<?php

namespace App\Http\Livewire\Partial;

use App\Helpers\BillHelper;
use Livewire\Component;

class BillInfo extends Component
{

    protected $listeners = ['updateBill'];

    public function mount()
    {
        session(['bill' => BillHelper::countBill()]);
    }
    public function render()
    {
        return view('livewire.partial.bill-info');
    }

    public function updateBill()
    {
        session(['bill' => BillHelper::countBill()]);
    }

}
