<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Customer extends Model
{
    protected $fillable = ['phone',
        'name',
        'address',
        'count_reservation_finished',
        'count_reservation',
        'member'
        ];

    public function scopeSearch($query, $search)
    {
        return $query
            ->where('name','like', "%$search%")
            ->orWhere('phone', 'like', "%$search%");
    }

    public function reservations(){
        return $this->hasMany(Reservation::class);
    }

    public function tickets(){
        return $this->hasMany(Ticket::class,'phone','phone');
    }

    public function packages(){
        return $this->hasMany(Package::class,'sender_phone','phone');
    }

    public function updateCustomerReservationCount()
    {
        $this->count_reservation++;
        $this->save();
    }

    public function updateCustomerCountReservationFinish()
    {
        $this->count_reservation_finished++;
        $this->save();
    }

}
