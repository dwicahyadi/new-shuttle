<?php

namespace App\Http\Livewire\Report;

use App\Helpers\ReportHelper;
use App\Models\City;
use Livewire\Component;
use Livewire\WithPagination;

class Settlement extends Component
{
    use WithPagination;

    public $cities, $date, $end_date, $point, $status;

    protected $updatesQueryString = ['point', 'date', 'end_date', 'status'];

    public function mount()
    {
        $this->cities = City::with(['points'])->get();
        $this->date = request('date') ?? date('Y-m-d');
        $this->end_date = request('end_date') ?? date('Y-m-d');
        $this->point = request('point');
    }

    public function render()
    {
        $report = ReportHelper::settlement($this->point, $this->date, $this->end_date);
        return view('livewire.report.settlement',['report'=>$report]);
    }
}
