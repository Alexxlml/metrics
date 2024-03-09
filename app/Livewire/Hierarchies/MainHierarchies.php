<?php

namespace App\Livewire\Hierarchies;

use App\Models\User;
use Livewire\Component;
use App\Models\Hierarchy;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class MainHierarchies extends Component
{
    use WithPagination;
    use LivewireAlert;

    protected $perPage = 10;
    protected $listeners = [
        'confirmed'
    ];
    public $selectedRole, $selectedBoss;

    public function render()
    {
        return view('livewire.hierarchies.main-hierarchies', [
            'roles' => Role::all()->except([5]),
            'subordinates' => User::whereHas('boss', function ($query) {
                $query->where('boss_id', 'like', $this->selectedBoss . '%');
            })->paginate($this->perPage),
        ]);
    }

    public function updatedSelectedRole()
    {
        $this->selectedBoss = '';
    }

    public function deleteHierarchy(int $subordinate_id)
    {
        $this->confirm('¿Deseas eliminar este subordinado?', [
            'confirmButtonText' => 'Si',
            'onConfirmed' => 'confirmed',
            'inputAttributes' => $subordinate_id,
            'allowOutsideClick' => false,
        ]);
    }

    public function confirmed($data)
    {
        $subordinate_id = $data;
        $subordinate = Hierarchy::where('subordinate_id', $subordinate_id);
        if ($subordinate) {
            $subordinate->delete();
        }
    }
}
