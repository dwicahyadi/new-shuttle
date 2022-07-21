<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    protected $fillable = [
        'city_id','code','name','address','phone','active'
    ];

    protected $hidden = ['created_at','updated_at'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class,'departure_point_id');
    }

    public function trips()
    {
        return $this->hasMany(Departure::class,'departure_point_id');
    }
}
