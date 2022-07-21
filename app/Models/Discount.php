<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    public function scopeSearch($query, $search)
    {
        return $query
            ->where('code','like', "%$search%")
            ->orWhere('name', 'like', "%$search%");
    }
}
