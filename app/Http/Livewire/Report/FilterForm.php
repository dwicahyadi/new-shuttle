<?php

namespace App\Http\Livewire\Report;

use App\Models\City;
use Livewire\Component;

class FilterForm extends Component
{
    public function render()
    {
        $cities = City::with('points')->get();
        return view('livewire.report.filter-form', compact('cities'));
    }
}
