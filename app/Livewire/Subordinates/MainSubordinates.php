<?php

namespace App\Livewire\Subordinates;

use Exception;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class MainSubordinates extends Component
{
    use WithPagination;

    protected $perPage = 10;

    public $userFromView, $roleUserFromView, $ownerUserName, $loggedUser;

    public function mount($id)
    {
        $this->userFromView = intval($id);
        $this->roleUserFromView = User::find($id)->getRoleNames()->first();
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
        return view('livewire.subordinates.main-subordinates', [
            'subordinates' => User::whereHas('boss', function ($query) {
                $query->where('boss_id', $this->userFromView);
            })->paginate($this->perPage),
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
