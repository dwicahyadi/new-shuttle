<?php

namespace App\Http\Livewire\Report;

use Livewire\Component;

class PackageDetail extends Component
{
    public function render()
    {
        $from_date = request('from_date') ?? now()->format('Y-m-d');
        $to_date = request('to_date') ?? now()->format('Y-m-d');
        $departure_point_id = request('departure_point_id');
        $arrival_point_id = request('arrival_point_id');


        $packages = \App\Models\Package::query()
            ->with(['departure','departure.departure_point','departure.arrival_point'])
            ->whereHas('departure', function ($q) use ($to_date, $from_date) {
                $q->whereBetween('date',[$from_date, $to_date]);
            });

        $packages->when($departure_point_id, function ($q) use ($departure_point_id) {
            $q->wherehas('departure', function ($q2) use ($departure_point_id) {
                $q2->where('departure_point_id','=',$departure_point_id);
            });
        });

        $packages->when($arrival_point_id, function ($q) use ($arrival_point_id) {
            $q->wherehas('departure', function ($q2) use ($arrival_point_id) {
                $q2->where('arrival_point_id','=',$arrival_point_id);
            });
        });

        $data = $packages->paginate();

        $i = $data->firstItem();
        return view('livewire.report.package-detail', compact('data', 'i'));
    }
}
