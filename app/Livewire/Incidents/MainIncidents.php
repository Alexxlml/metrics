<?php

namespace App\Livewire\Incidents;

use Exception;
use App\Models\User;
use Livewire\Component;
use App\Models\Incident;
use Livewire\WithPagination;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class MainIncidents extends Component
{
    use WithPagination;
    use LivewireAlert;

    protected $perPage = 10;

    public $userFromView, $ownerUserName, $loggedUser;
    public $changeStateModal = false;
    public $statuses = [];
    public $incidentId;

    #[Validate('required', as: 'estado de la incidencia')]
    public $statusToChange = '';

    public function mount($id)
    {
        $this->userFromView = $id;
        $this->ownerUserName = User::find($id)->name;
        $this->loggedUser = Auth::user()->id;

        if (is_numeric($id)) {
            if (!$this->checkuserFromViewOrBoss($this->userFromView)) {
                abort(403, 'No tienes permiso para acceder a este contenido');
            }
        } else {
            abort(404);
        }

        $this->statuses = [
            'realizada',
            'rechazada',
            'pendiente'
        ];
    }

    public function render()
    {
        return view('livewire.incidents.main-incidents', [
            'incidents' => Incident::where('boss_id', $this->userFromView)
                ->orderBy('id', 'desc')
                ->paginate($this->perPage),
        ]);
    }

    public function openModalToChange($incident_id)
    {
        $this->incidentId = $incident_id;
        $this->changeStateModal = true;
    }

    public function changeStateOfIncident()
    {
        $this->validate();
        $incident = Incident::find($this->incidentId);
        $incident->status = $this->statusToChange;
        $incident->save();

        $this->statusToChange = '';
        $this->changeStateModal = false;

        $this->alert('success', 'Estado de la incidencia cambiado', [
            'position' => 'center',
            'timer' => '3000',
            'toast' => false,
            'timerProgressBar' => true,
        ]);
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
