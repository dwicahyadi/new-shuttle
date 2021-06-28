<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarMaintenanceHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_id',
        'date',
        'note',
        'next_maintenance_date',
    ];

    public function  car()
    {
        return $this->belongsTo(Car::class);
    }

    public function scopeSearch($query, $search)
    {
        return $query
            ->where('note','like', "%$search%")
            ->orWhere('date', 'like', "%$search%");
    }
}
