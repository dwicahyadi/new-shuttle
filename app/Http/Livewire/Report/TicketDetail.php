<?php

namespace App\Http\Livewire\Report;

use Livewire\Component;

class TicketDetail extends Component
{
    public function render()
    {
        $from_date = request('from_date') ?? now()->format('Y-m-d');
        $to_date = request('to_date') ?? now()->format('Y-m-d');
        $departure_point_id = request('departure_point_id');
        $arrival_point_id = request('arrival_point_id');


        $tickets = \App\Models\Ticket::query()
            ->with(['departure','departure.departure_point','departure.arrival_point', 'user_payment','user_reservation'])
            ->whereBetween('tickets.date',[$from_date, $to_date]);

        $tickets->when($departure_point_id, function ($q) use ($departure_point_id) {
            $q->wherehas('departure', function ($q2) use ($departure_point_id) {
                $q2->where('departure_point_id','=',$departure_point_id);
            });
        });

        $tickets->when($arrival_point_id, function ($q) use ($arrival_point_id) {
            $q->wherehas('departure', function ($q2) use ($arrival_point_id) {
                $q2->where('arrival_point_id','=',$arrival_point_id);
            });
        });

        $data = $tickets->paginate();
        $i = $data->firstItem();
        return view('livewire.report.ticket-detail', compact('data', 'i'));
    }
}
