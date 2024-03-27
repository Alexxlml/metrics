<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeopleForm extends Model
{
    protected $fillable = [
        'user_id',
        'first_name',
        'second_name',
        'first_surname',
        'second_surname',
        'electoral_key',
        'phone',
        'address',
        'neighborhood_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function neighborhood()
    {
        return $this->belongsTo(Neighborhood::class);
    }
}
