<?php

namespace App\Http\Livewire\Report;

use App\Models\City;
use App\Models\SummaryReport;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Package extends Component
{
    use WithPagination;

    public $cities, $date, $end_date, $point;

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
        $report = \App\Models\Package::query();
        $report->with(['user','departure_point']);
        if ($this->point) $report->where('departure_point_id', $this->point);

        $report->whereBetween(DB::raw('date(created_at)'), [$this->date, $this->end_date]);
        return view('livewire.report.package',['report'=>$report->get()]);
    }
}
