<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    protected $guarded = [];

    public function tickets()
    {
        return $this->belongsToMany(Ticket::class);
    }
}

