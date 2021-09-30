<?php

namespace App\Http\Livewire\Report;

use App\Helpers\ReportHelper;
use App\Models\City;
use Livewire\Component;

class Occupancy extends Component
{
    public $cities, $date, $end_date, $point;

    protected $updatesQueryString = ['point', 'date'];

    public function mount()
    {
        $this->cities = City::with(['points'])->get();
        $this->date = request('date') ?? date('Y-m-d');
        $this->end_date = request('end_date') ?? date('Y-m-d');
        $this->point = request('point');
    }
    public function render()
    {
        $report = ReportHelper::ocupancy($this->point, $this->date, $this->end_date);
        return view('livewire.report.occupancy',['report'=>$report]);
    }
}
