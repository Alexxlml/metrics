<?php

namespace App\Livewire\PeopleForms;

use App\Livewire\Forms\PeopleForms\IncidentsPeopleForms;
use App\Models\Incident;
use Exception;
use App\Models\User;
use Livewire\Component;
use App\Models\PeopleForm;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class MainPeopleForms extends Component
{
    use WithPagination;
    use LivewireAlert;

    protected $perPage = 10;
    protected $listeners = [
        'confirmed'
    ];
    public $userFromView, $loggedUser, $ownerUserName;
    public IncidentsPeopleForms $incidentForm;
    public $formToChange;
    public $modalRequest = false;

    public function mount($id)
    {
        $this->userFromView = intval($id);
        $this->ownerUserName = User::find($id)->name;
        $this->loggedUser = Auth::user()->id;

        if (is_numeric($id)) {
            if (!$this->checkuserFromViewOrBoss($this->userFromView)) {
                abort(403, 'No tienes permiso para acceder a este contenido');
            }
        } else {
            abort(404);
        }
    }

    public function render()
    {
        return view('livewire.people-forms.main-people-forms', [
            'forms' => PeopleForm::with('neighborhood.town')
                ->where('user_id', $this->userFromView)
                ->paginate($this->perPage),
            'count_forms' => PeopleForm::where('user_id', $this->userFromView)->count(),
        ]);
    }

    public function deleteForm($form_id): void
    {
        $this->confirm('¿Deseas eliminar este formulario?', [
            'confirmButtonText' => 'Si',
            'onConfirmed' => 'confirmed',
            'inputAttributes' => $form_id,
            'allowOutsideClick' => false,
        ]);
    }

    public function confirmed($data): void
    {
        $form_id = $data;
        $form = PeopleForm::where('id', $form_id);
        if ($form) {
            $form->delete();
        }
    }

    public function openModalToChange($form_id)
    {
        if ($form_id) {
            $this->formToChange = $form_id;
            $this->modalRequest = true;
        }
    }

    public function sendRequestOfFieldChange()
    {
        $this->validate();
        $incident = Incident::Create([
            'form_id' => $this->formToChange,
            'boss_id' => $this->getBossId(),
            'subordinate_id' => $this->userFromView,
            'field_to_change' => $this->incidentForm->fieldToChange,
            'description_of_field' => $this->incidentForm->descriptionOfField,
            'status' => 'pendiente'
        ]);
        $incident->save();
        $this->resetModalState();

        $this->alert('success', 'Solicitud enviada', [
            'position' => 'center',
            'timer' => '3000',
            'toast' => false,
            'timerProgressBar' => true,
        ]);
    }

    public function getBossId()
    {
        return User::find($this->userFromView)->boss->boss_id;
    }

    public function resetModalState()
    {
        $this->formToChange = null;
        $this->incidentForm->fieldToChange = '';
        $this->incidentForm->descriptionOfField = '';
        $this->modalRequest = false;
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
