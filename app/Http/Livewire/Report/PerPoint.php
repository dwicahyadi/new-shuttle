<?php

namespace App\Http\Livewire\Report;

use App\Models\Point;
use Livewire\Component;

class PerPoint extends Component
{
    public function render()
    {
        $from_date = request('from_date') ?? now()->format('Y-m-d');
        $to_date = request('to_date') ?? now()->format('Y-m-d');

        $data = \DB::table('tickets')
            ->join('points','tickets.departure_point_id','=','points.id','left')
            ->join('cities','points.city_id','=','cities.id','left')
            ->select(
                'points.*',
                'cities.name as city',
                \DB::raw('sum(tickets.price) as omzet'),
                \DB::raw('count(tickets.id) as tickets_count'),
                \DB::raw('count(distinct tickets.departure_id) as trips_count'),
            )
            ->groupBy('points.id')
            ->where('tickets.status','=','paid')
            ->whereBetween('tickets.date',[$from_date, $to_date])
            ->get();
        return view('livewire.report.per-point',compact('data'));
    }
}
