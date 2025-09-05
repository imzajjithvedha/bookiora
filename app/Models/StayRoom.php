<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StayRoom extends Model
{
    protected $guarded = [];
    
    public function stay()
    {
        return $this->belongsTo(Stay::class);
    }
}
