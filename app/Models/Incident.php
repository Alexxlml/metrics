<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    use HasFactory;

    protected $fillable = [
        'form_id',
        'boss_id',
        'subordinate_id',
        'field_to_change',
        'description_of_field',
        'status'
    ];

    public function form()
    {
        return $this->belongsTo(PeopleForm::class, 'form_id');
    }
}
