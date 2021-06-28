<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ledger extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'category',
        'description',
        'amount',
    ];

    public function scopeSearch($query, $search)
    {
        return $query
            ->where('category','like', "%$search%")
            ->orWhere('description', 'like', "%$search%")
            ->orWhere('date', 'like', "%$search%");
    }
}
