<?php
namespace App\Helpers;

use App\Models\Schedule;
use App\Models\Settlement;
use Illuminate\Support\Facades\DB;

class ReportHelper
{
    public static function omzet($point_id, $month, $year)
    {
        $data = DB::table('tickets')
            ->join('departures','tickets.departure_id','=','departures.id')
            ->select(['departures.date',DB::raw('count(tickets.id) as total_tickets'), DB::raw('sum(tickets.price) as amount_tickets')])
            ->whereMonth('departures.date', $month)
            ->whereYear('departures.date', $year)
            ->where('departures.departure_point_id',$point_id)
            ->whereNotNull('tickets.payment_by')
            ->groupBy('departures.date')
            ->orderBy('departures.date')
            ->get();
        return $data;
    }

    public static function settlement($point_id, $date, $end_date)
    {
        return Settlement::whereHas('user', function ($query) use($point_id){
            if ($point_id) {
                return $query->where('point_id', $point_id);
            }
            return $query;
        })->whereBetween('created_at',[$date, $end_date])->get();
    }

    public static function ocupancy($point_id, $date, $end_date)
    {
        return Schedule::with(['paidTickets','departures','departures.arrival_point', 'departures.departure_point'])
            ->whereHas('departures',function ($query) use($end_date, $point_id, $date){
                return $query->whereDate('date','>=', $date)
                    ->whereDate('date','<=', $end_date)
                    ->where('departure_point_id', $point_id)
                    ->whereNotNull('is_manifested');
            })
            ->get();
    }
}
