<?php

namespace App\Livewire\Forms\PeopleForms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class IncidentsPeopleForms extends Form
{
    #[Validate('required', as: 'a actualizar')]
    public $fieldToChange = '';

    #[Validate('required', as: 'descripción del cambio')]
    public $descriptionOfField = '';
}
