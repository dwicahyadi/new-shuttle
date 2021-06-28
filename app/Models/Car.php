<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Car extends Model
{
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
    public function scopeSearch($query, $search)
    {
        return $query
            ->where('code','like', "%$search%")
            ->orWhere('license_number', 'like', "%$search%");
    }

    public function history()
    {
        return DB::table('schedules')
            ->leftJoin('departures','departures.schedule_id','=','schedules.id')
            ->leftJoin('points','points.id','=','departures.departure_point_id')
            ->leftJoin('points as points2','points2.id','=','departures.arrival_point_id')
            ->leftJoin('drivers','drivers.id','=','schedules.driver_id')
            ->where('schedules.car_id',$this->id)
            ->select('car_id',
                'driver_id',
                DB::raw('drivers.name as driver_name'),
                'costs',
                'departures.date',
                'departures.time',
                DB::raw('points.id as departure_point_id'),
                DB::raw('points.name as departure_point_name'),
                DB::raw('points2.id as arrival_point_id'),
                DB::raw('points2.name as arrival_point_name')
            );
    }
}
