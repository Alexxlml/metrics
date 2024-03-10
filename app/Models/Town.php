<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Town extends Model
{

    protected $fillable = [
        'name',
    ];

    public function neighborhoods()
    {
        return $this->hasMany(Neighborhood::class);
    }
}
