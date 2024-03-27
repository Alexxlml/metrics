<?php

namespace App\Livewire\PeopleForms;

use Exception;
use App\Models\Town;
use App\Models\User;
use Livewire\Component;
use App\Models\PeopleForm;
use App\Models\Neighborhood;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class EditPeopleForms extends Component
{
    use LivewireAlert;

    protected $listeners = [
        'confirmed'
    ];

    public $formId, $ownerUserId, $loggedUser, $originalUser;

    // * Variables del formulario
    #[Validate('required|regex:/^[\pL\pM\s]+$/u|max:255', as: 'primer nombre')]
    public $firstName;
    #[Validate('nullable|regex:/^[\pL\pM\s]+$/u|max:255', as: 'segundo nombre')]
    public $secondName;
    #[Validate('required|regex:/^[\pL\pM\s]+$/u|max:255', as: 'primer apellido')]
    public $firstSurName;
    #[Validate('nullable|regex:/^[\pL\pM\s]+$/u|max:255', as: 'segundo apellido')]
    public $secondSurName;
    public $electoral_key;
    #[Validate('required|numeric|digits:10', as: 'teléfono')]
    public $phone;
    #[Validate('required|string|max:255', as: 'dirección')]
    public $address;
    #[Validate('required|string|min:1|max:2', as: 'poblado')]
    public $selectedTown = '';
    #[Validate('required|string|min:1|max:2', as: 'colonia')]
    public $selectedNeighborhood = '';

    public function mount($id)
    {
        $form = PeopleForm::find($id);
        $form ? $this->fillVariables($form) : abort(404);
        
        $this->loggedUser = Auth::user()->id;
        if (!$this->checkuserFromViewOrBoss($this->originalUser)) {
            abort(403, 'No tienes permiso para acceder a este contenido');
        }

    }

    public function render()
    {
        return view(
            'livewire.people-forms.edit-people-forms',
            [
                'towns' => Town::all(),
                'neighborhoods' => Neighborhood::where('town_id', 'like', $this->selectedTown)
                    ->get(),
            ]
        );
    }

    public function save(): void
    {
        $this->confirm('¿Deseas actualizar este formulario?', [
            'confirmButtonText' => 'Si',
            'onConfirmed' => 'confirmed',
            'allowOutsideClick' => false,
        ]);
    }

    public function confirmed(): void
    {
        $this->validate();
        $this->updateFormAndSave();
    }

    public function redirectToPanel()
    {
        return redirect()->route('panel-formularios', ['id' => strval($this->ownerUserId)]);
    }

    public function updatedSelectedTown(): void
    {
        $this->selectedNeighborhood = '';
    }

    public function fillVariables($form): void
    {
        $this->formId = $form->id;
        $this->ownerUserId = $form->user_id;
        $this->originalUser = $form->user_id;
        $this->firstName = $form->first_name;
        $this->secondName = $form->second_name;
        $this->firstSurName = $form->first_surname;
        $this->secondSurName = $form->second_surname;
        $this->electoral_key = $form->electoral_key;
        $this->phone = $form->phone;
        $this->address = $form->address;
        $this->selectedNeighborhood = strval($form->neighborhood_id);
        $this->selectedTown = strval(Neighborhood::find($this->selectedNeighborhood)->town_id);
    }

    public function updateFormAndSave(): void
    {
        $form = PeopleForm::find($this->formId);
        if ($form) {
            $form->update([
                'first_name' => $this->firstName,
                'second_name' => $this->secondName,
                'first_surname' => $this->firstSurName,
                'second_surname' => $this->secondSurName,
                'phone' => $this->phone,
                'address' => $this->address,
                'neighborhood_id' => $this->selectedNeighborhood,
            ]);
            $form->save();

            $this->alert('success', 'Formulario actualizado', [
                'position' => 'center',
                'timer' => '3000',
                'toast' => false,
                'timerProgressBar' => true,
            ]);
        } else {
            $this->alert('error', 'Este formulario fue eliminado.', [
                'position' => 'center',
                'timer' => '6000',
                'toast' => false,
                'timerProgressBar' => true,
                'text' => 'Has clic en el botón: "Regresar al panel"',
            ]);
        }
    }

    public function checkuserFromViewOrBoss($user_from_view): bool
    {
        $flag = false;
        $searched_user = 0;
        $check = true;
        $array_of_users = [];

        if ($user_from_view === $this->loggedUser) {
            $flag = true;
        } else {
            while ($check == true) {
                try {
                    $searched_user = User::findOrFail($user_from_view)->boss()->get()[0]->boss_id;
                    array_push($array_of_users, $searched_user);
                    $user_from_view = $searched_user;
                    $check = true;
                } catch (Exception $err) {
                    $check = false;
                }
            }
            if (in_array($this->loggedUser, $array_of_users)) {
                $flag = true;
            }
        }

        return $flag;
    }
}
