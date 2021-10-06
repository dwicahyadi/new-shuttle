<?php

namespace App\Http\Livewire\Report;

use App\Helpers\ReportHelper;
use App\Models\City;
use App\Models\Driver;
use App\Models\Schedule;
use Livewire\Component;

class OperationalCost extends Component
{
    public $cities, $date, $end_date, $point, $drivers, $driver_id;

    public function mount()
    {
        $this->drivers = Driver::all();
        $this->cities = City::with(['points'])->get();
        $this->date = request('date') ?? date('Y-m-d');
        $this->end_date = request('end_date') ?? date('Y-m-d');
        $this->point = request('point');
    }
    public function render()
    {
        $report = Schedule::with(['car','driver','departures'])
            ->whereHas('departures',function($q){
                return $q->whereDate('date','>=',$this->date)
                    ->whereDate('date','<=', $this->end_date)
                    ->where('is_manifested',true);
            })
            ->orderBy('updated_at');

        if($this->driver_id)
            $report->whereHas('driver', function ($q){
                return $q->where('id', $this->driver_id);
            });

        if($this->point)
            $report->whereHas('departures', function ($q){
                return $q->where('departure_point_id', $this->point);
            });

        return view('livewire.report.operational-cost',['report'=>$report->get()]);
    }
}
