<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Neighborhood extends Model
{

    protected $fillable = [
        'name',
        'town_id',
    ];

    public function town()
    {
        return $this->belongsTo(Town::class);
    }
}
