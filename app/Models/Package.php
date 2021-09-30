<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Package extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'departure_id',
        'departure_point_id',
        'sender_name',
        'sender_phone',
        'receiver_name',
        'receiver_phone',
        'weight',
        'piece',
        'type',
        'content',
        'status',
        'payment_by',
        'payment_at',
        'settlement_id',
        'price',
    ];

    public function departure()
    {
        return $this->belongsTo(Departure::class);
    }

    public function departure_point()
    {
        return $this->belongsTo(Point::class,'departure_point_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'payment_by');
    }
}
