<?php

namespace App\Livewire\PeopleForms;

use App\Models\Town;
use Livewire\Component;
use App\Models\PeopleForm;
use App\Models\Neighborhood;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class AddPeopleForms extends Component
{
    use LivewireAlert;

    protected $listeners = [
        'confirmed'
    ];

    // * Variables del formulario
    #[Validate('required|regex:/^[\pL\pM\s]+$/u|max:255', as: 'primer nombre')]
    public $firstName;
    #[Validate('nullable|regex:/^[\pL\pM\s]+$/u|max:255', as: 'segundo nombre')]
    public $secondName;
    #[Validate('required|regex:/^[\pL\pM\s]+$/u|max:255', as: 'primer apellido')]
    public $firstSurName;
    #[Validate('nullable|regex:/^[\pL\pM\s]+$/u|max:255', as: 'segundo apellido')]
    public $secondSurName;
    #[Validate(as: 'clave electoral')]
    public $electoral_key;
    #[Validate('required|numeric|digits:10', as: 'teléfono')]
    public $phone;
    #[Validate('required|string|max:255', as: 'dirección')]
    public $address;
    #[Validate('required|string|min:1|max:2', as: 'poblado')]
    public $selectedTown = '';
    #[Validate('required|string|min:1|max:2', as: 'colonia')]
    public $selectedNeighborhood = '';

    public function rules()
    {
        return [
            'electoral_key' => [
                'required',
                'regex:/\b(?:[A-Z][B-DF-HJ-NP-TV-Z]){3}[0-9]{2}(?:0[1-9]|1[0-2])(?:[1-2][0-9]|0[1-9]|3[0-1])(?:0[1-9]|[1-2][0-9]|3[0-2]|88|87)[HM][0-9]{3}\b/',
                Rule::unique('people_forms'),
                'max:18',
            ],
        ];
    }

    // * Usuario que crea un formulario
    public $userId;
    public function mount()
    {
        $this->getCurrentUserId();
    }

    public function render()
    {
        return view('livewire.people-forms.add-people-forms', [
            'towns' => Town::all(),
            'neighborhoods' => Neighborhood::where('town_id', 'like', $this->selectedTown)
                ->get(),
        ]);
    }

    public function save(): void
    {
        $this->confirm('¿Deseas guardar este formulario?', [
            'confirmButtonText' => 'Si',
            'onConfirmed' => 'confirmed',
            'allowOutsideClick' => false,
        ]);
    }

    public function confirmed(): void
    {
        $this->validate();

        PeopleForm::Create([
            'user_id' => $this->userId,
            'first_name' => $this->firstName,
            'second_name' => $this->secondName,
            'first_surname' => $this->firstSurName,
            'second_surname' => $this->secondSurName,
            'electoral_key' => $this->electoral_key,
            'phone' => $this->phone,
            'address' => $this->address,
            'neighborhood_id' => $this->selectedNeighborhood,
        ]);

        $this->reset();

        $this->alert('success', 'Formulario agregado', [
            'position' => 'center',
            'timer' => '3000',
            'toast' => false,
            'timerProgressBar' => true,
        ]);
    }

    public function redirectToPanel()
    {
        $this->getCurrentUserId();
        return redirect()->route('panel-formularios', ['id' => strval($this->userId)]);
    }

    public function updatedSelectedTown(): void
    {
        $this->selectedNeighborhood = '';
    }

    public function getCurrentUserId(): void
    {
        $this->userId = Auth::user()->id;
    }
}
