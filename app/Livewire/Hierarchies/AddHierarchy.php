<?php

namespace App\Livewire\Hierarchies;

use Livewire\Component;
use App\Models\Hierarchy;
use Exception;
use Livewire\Attributes\Validate;
use Spatie\Permission\Models\Role;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class AddHierarchy extends Component
{
    use LivewireAlert;

    // * Validaciones Jefe
    #[Validate('required', as: 'rol del jefe')]
    public $selectedBossRoleForAdd = '';
    #[Validate('required', as: 'nombre del jefe')]
    public $selectedBossIdForAdd = '';

    // * Validaciones subordinado
    #[Validate('required', as: 'nombre del subordinado')]
    public $selectedSubordinateRoleForAdd = '';
    #[Validate('required', as: 'nombre del subordinado')]
    public $selectedSubordinateIdForAdd = '';

    public function render()
    {
        return view('livewire.hierarchies.add-hierarchy', [
            'boss_roles' => Role::all()->except([5]),
        ]);
    }

    public function updatedSelectedBossRoleForAdd()
    {
        $this->selectedBossIdForAdd = '';
        $this->selectedSubordinateRoleForAdd = '';
        $this->selectedSubordinateIdForAdd = '';
    }

    public function save()
    {
        $this->validate();

        $hierarchiesIds = $this->getIntegerIds($this->selectedBossIdForAdd, $this->selectedSubordinateIdForAdd);

        try {
            Hierarchy::Create([
                'boss_id' => $hierarchiesIds['boss_id'],
                'subordinate_id' => $hierarchiesIds['subordinate_id'],
            ]);
            $this->reset();

            $this->alert('success', 'Subordinado agregado', [
                'position' => 'center',
                'timer' => '4000',
                'toast' => false,
                'timerProgressBar' => true,
            ]);
        } catch (Exception $e) {
            $this->getErrorNotification($e->getMessage());
        }
    }

    public function getIntegerIds(string $bossId, string $subordinateId): array
    {
        return [
            'boss_id' => intval($bossId),
            'subordinate_id' => intval($subordinateId)
        ];
    }

    public function getErrorNotification(string $errorMessage): void
    {
        if (strstr($errorMessage, '1062 Duplicate entry')) {
            $this->alert('error', 'Entrada duplicada', [
                'position' => 'center',
                'timer' => '4000',
                'toast' => false,
                'timerProgressBar' => true,
                'text' => 'Este subordinado ya tiene un jefe asignado.',
            ]);
        } else {
            $this->alert('error', 'Ha ocurrido un error', [
                'position' => 'center',
                'timer' => '4000',
                'toast' => false,
                'timerProgressBar' => true,
                'text' => 'No se ha podido asignar este subordinado, intentalo de nuevo.',
            ]);
        }
    }
}
