<?php

namespace App\Http\Livewire\Partial;

use App\Helpers\BillHelper;
use Livewire\Component;

class PackageBillInfo extends Component
{

    protected $listeners = ['updatePackageBill'];

    public function mount()
    {
        session(['package-bill' => BillHelper::countPackageBill()]);
    }
    public function render()
    {
        return view('livewire.partial.package-bill-info');
    }

    public function updatePackageBill()
    {
        session(['package-bill' => BillHelper::countPackageBill()]);
    }

}
