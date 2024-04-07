<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'name'
    ];

    public function peopleForms()
    {
        return $this->hasMany(PeopleForm::class);
    }
}
