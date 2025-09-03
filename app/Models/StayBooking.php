<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StayBooking extends Model
{
    protected $guarded = [];

    public function stays()
    {
        return $this->belongsTo(Stay::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
