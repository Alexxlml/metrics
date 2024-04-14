<?php

namespace App\Livewire\PeopleForms;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use App\Models\Incident;
use App\Models\PeopleForm;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Livewire\Forms\PeopleForms\IncidentsPeopleForms;

class MainPeopleForms extends Component
{
    use WithPagination;
    use LivewireAlert;

    protected $listeners = [
        'confirmed'
    ];

    // * Variables barra de búsqueda
    public $search = "";
    public $perPage = 5;
    public $sortBy = 'id';
    public $sortAsc = true;

    public $userFromView, $loggedUser, $ownerUserName;
    public IncidentsPeopleForms $incidentForm;
    public $formToChange;
    public $modalRequest = false;
    public $showCheckVote = true;
    public $authorizeChangeVote = false;

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
        // * Definir las fechas de inicio y fin del rango
        $initRange = Carbon::create(2024, 6, 2, 7, 0, 0); // 02 de Junio del 2024 a las 7 AM
        $endRange = Carbon::create(2024, 6, 2, 19, 0, 0);   // 02 de Junio del 2024 a las 7 PM
        // * Obtener fecha y hora actual
        $actualDate = Carbon::now();

        // * Bloqueo de columna voto hasta que la fecha actual cumpla con las fechas y horas establecidas
        $this->showCheckVote = ($actualDate->gte($initRange) && $actualDate->lte($endRange)) ?
            true : false;

        $this->authorizeChangeVote = ($this->userFromView == $this->loggedUser) ?
            true : false;
    }

    public function render()
    {
        return view('livewire.people-forms.main-people-forms', [
            'forms' => PeopleForm::with('neighborhood.town')
                ->where('user_id', $this->userFromView)
                ->where('id', 'LIKE', "%{$this->search}%")
                ->orWhere('first_name', 'LIKE', "%{$this->search}%")
                ->orWhere('second_name', 'LIKE', "%{$this->search}%")
                ->orWhere('first_surname', 'LIKE', "%{$this->search}%")
                ->orWhere('second_surname', 'LIKE', "%{$this->search}%")
                ->orderBy($this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')
                ->paginate($this->perPage),
            'count_forms' => PeopleForm::where('user_id', $this->userFromView)->count(),
        ]);
    }

    public function changeSortBy($sortBy)
    {
        $this->sortBy = $sortBy;
        $this->sortAsc = true;
    }

    public function changeSortAsc($sortBy)
    {
        $this->sortBy = $sortBy;
        $this->sortAsc = !$this->sortAsc;
    }

    public function changeVoteState($form_id, $vote_state)
    {
        if ($this->showCheckVote && $this->authorizeChangeVote) {
            $form = PeopleForm::find($form_id);
            if ($form) {
                try {
                    $new_state = $vote_state ? false : true;
                    $form->update(['vote' => $new_state]);
                    $form->save();

                    $this->alert('success', 'Cambio exitoso.', [
                        'position' => 'center',
                        'timer' => '1500',
                        'toast' => false,
                        'timerProgressBar' => true,
                    ]);
                } catch (Exception $err) {
                    $this->alert('error', 'Ha ocurrido un error.', [
                        'position' => 'center',
                        'timer' => '4000',
                        'toast' => false,
                        'timerProgressBar' => true,
                        'text' => 'Recargue la página e intente de nuevo.',
                    ]);
                }
            } else {
                $this->alert('error', 'Este formulario ya no existe.', [
                    'position' => 'center',
                    'timer' => '4000',
                    'toast' => false,
                    'timerProgressBar' => true,
                ]);
            }
        }
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
