<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hierarchy extends Model
{
    protected $fillable = [
        'boss_id',
        'subordinate_id'
    ];

    public function boss()
    {
        return $this->belongsTo(User::class, 'boss_id');
    }

    public function subordinate()
    {
        return $this->belongsTo(User::class, 'subordinate_id');
    }
}
