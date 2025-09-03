<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stay extends Model
{
    protected $guarded = [];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bookings()
    {
        return $this->hasMany(StayBooking::class);
    }

    public function reviews()
    {
        return $this->hasMany(WarehouseReview::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
