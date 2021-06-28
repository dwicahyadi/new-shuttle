<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;

class Ticket extends Model
{
    protected $fillable = [
        'departure_id',
        'phone',
        'name',
        'seat',
        'discount_id',
        'name_name',
        'discount_amount',
        'price',
        'status',
        'reservation_by',
        'reservation_at',
        'payment_by',
        'payment_at',
        'settlement_id',
        'departure_point_id',
        'note',
        'date',
        'is_multiroute',
    ];


    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function departure()
    {
        return $this->belongsTo(Departure::class);
    }

    public function departure_point()
    {
        return $this->belongsTo(Point::class,'departure_point_id','id');
    }

    public function arrival_point()
    {
        return $this->belongsTo(Point::class,'arrival_point_id','id');
    }

    public static function yetSettlement ()
    {
        return DB::table('tickets')
            ->leftJoin('departures','departures.id','=','tickets.departure_id')
            ->leftJoin('points','points.id','=','departures.departure_point_id')
            ->leftJoin('points as points2','points2.id','=','departures.arrival_point_id')
            ->whereNull('tickets.settlement_id')
            ->select('tickets.settlement_id',
                DB::raw('tickets.id as ticket_id'),
                'tickets.reservation_id',
                'departures.id','tickets.phone',
                'tickets.name',
                'tickets.payment_by',
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
