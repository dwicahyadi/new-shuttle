<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;

class Settlement extends Model
{
    use LogsActivity;

    protected $fillable = [
        'user_id',
        'amount',
        'note',
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function detail ()
    {
        return DB::table('tickets')
            ->leftJoin('departures','departures.id','=','tickets.departure_id')
            ->leftJoin('points','points.id','=','departures.departure_point_id')
            ->leftJoin('points as points2','points2.id','=','departures.arrival_point_id')
            ->where('tickets.settlement_id',$this->id)
            ->select('tickets.settlement_id',
                DB::raw('tickets.id as ticket_id'),
                'tickets.reservation_id',
                'departures.id','tickets.phone',
                'tickets.name',
                DB::raw('points.id as departure_point_id'),
                DB::raw('points.name as departure_point_name'),
                DB::raw('points2.id as arrival_point_id'),
                DB::raw('points2.name as arrival_point_name'),
                'tickets.payment_method',
                'tickets.discount_id',
                DB::raw('if(tickets.discount_name is null, "Umum", tickets.discount_name) as discount_name'),
                'tickets.price')
            ->get();
    }

}
