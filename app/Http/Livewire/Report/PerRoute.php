<?php

namespace App\Http\Livewire\Report;

use Livewire\Component;

class PerRoute extends Component
{
    public function render()
    {
        $from_date = request('from_date') ?? now()->format('Y-m-d');
        $to_date = request('to_date') ?? now()->format('Y-m-d');
        $departure_point_id = request('departure_point_id');
        $arrival_point_id = request('arrival_point_id');

        $builder = \DB::table('tickets')
            ->join('departures','tickets.departure_id','=','departures.id','left')
            ->join('points as departure_point','departures.departure_point_id','=','departure_point.id','left')
            ->join('points as arrival_point','departures.arrival_point_id','=','arrival_point.id','left')
            ->select(
                'departures.*','departure_point.name as from_point',
                'arrival_point.name as to_point',
                \DB::raw('sum(tickets.price) as omzet'),
                \DB::raw('count(tickets.id) as tickets_count'),
                \DB::raw('count(distinct departures.id) as trips_count'),
            )
            ->groupBy('departures.departure_point_id','departures.arrival_point_id')
            ->where('tickets.status','=','paid')
            ->whereBetween('tickets.date',[$from_date, $to_date]);

        $builder->when($departure_point_id, function ($q) use ($departure_point_id) {
            $q->where('departures.departure_point_id','=',$departure_point_id);
        });

        $builder->when($arrival_point_id, function ($q) use ($arrival_point_id) {
            $q->where('departures.arrival_point_id','=',$arrival_point_id);
        });

        $data = $builder->get();



        return view('livewire.report.per-route', compact('data'));
    }
}
