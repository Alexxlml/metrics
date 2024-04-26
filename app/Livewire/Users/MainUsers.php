<?php

namespace App\Livewire\Users;

use Exception;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class MainUsers extends Component
{
    use LivewireAlert;
    use WithPagination;
    use WithFileUploads;

    protected $listeners = [
        'changePasswordConfirmed',
        'deleteConfirmed'
    ];

    // * Variables barra de búsqueda
    public $search = "";
    public $perPage = 5;
    public $sortBy = 'id';
    public $sortAsc = true;

    // * Variables cambio de contraseña
    public $userToChange;
    public $showModal = false;

    #[Validate('required|string|min:8', as: 'contraseña')]
    public $password;

    // * Variables subida de archivos
    public $showUploadModal = false;

    #[Validate('required|mimes:json|max:1024', as: 'archivo json')]
    public $fillFile;

    public function render()
    {
        return view('livewire.users.main-users', [
            'users' => User::where('name', 'LIKE', "%{$this->search}%")
                ->orWhere('email', 'LIKE', "%{$this->search}%")
                ->orWhere('phone', 'LIKE', "%{$this->search}%")
                ->orderBy($this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')
                ->paginate($this->perPage),
        ]);
    }

    public function updatedPerPage()
    {
        $this->resetPage();
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

    public function openModalToChange($user_id)
    {
        if ($user_id) {
            $this->userToChange = $user_id;
            $this->password = null;
            $this->showModal = true;
        }
    }

    public function deleteUser($id)
    {
        $this->confirm('¿Deseas eliminar este usuario?', [
            'confirmButtonText' => 'Si',
            'onConfirmed' => 'deleteConfirmed',
            'inputAttributes' => $id,
            'allowOutsideClick' => false,
            'text' => 'Asegurate de que el usuario no tiene ningún registro o jerarquía,
             en caso de tenerlos, cambia la contraseña para limitar el acceso, sin perder registros.',
        ]);
    }

    public function deleteConfirmed($data)
    {
        $id = $data['inputAttributes'];
        $user = User::find($id);

        if ($user) {
            $user->delete();

            $this->alert('success', 'El usuario se eliminó exitosamente.', [
                'position' => 'center',
                'timer' => '1500',
                'toast' => false,
                'timerProgressBar' => true,
            ]);
        }
    }

    public function changePassword()
    {
        $this->confirm('¿Deseas cambiar la contraseña de este usuario?', [
            'confirmButtonText' => 'Si',
            'onConfirmed' => 'changePasswordConfirmed',
            'allowOutsideClick' => false,
        ]);
    }

    public function changePasswordConfirmed()
    {
        if ($this->userToChange) {
            $this->validateOnly('password');
            $user = User::find($this->userToChange);
            $user->update([
                'password' => bcrypt($this->password),
            ]);
            $user->save();

            $this->userToChange = null;
            $this->password = null;

            $this->showModal = false;

            $this->alert('success', 'Cambio exitoso.', [
                'position' => 'center',
                'timer' => '1500',
                'toast' => false,
                'timerProgressBar' => true,
            ]);
        }
    }

    public function createMultipleUsers()
    {
        $this->validateOnly('fillFile');
        $users = Storage::json("livewire-tmp/" . $this->fillFile->getFilename());

        if ($users) {
            foreach ($users as $user) {
                $email = $this->getUserEmail($user);
                $password = $this->getUserPassword($user);
                try {
                    $new_user = User::create([
                        "name" => $user['full_name'],
                        "email" => $email,
                        "phone" => $user['phone'],
                        "password" => bcrypt($password),
                    ]);

                    $new_user->assignRole($user['role']);
                } catch (Exception $err) {
                }
            }

            $this->fillFile = null;
            $this->showUploadModal = false;

            $this->alert('success', 'Creación de archivos exitosa.', [
                'position' => 'center',
                'timer' => '2000',
                'toast' => false,
                'timerProgressBar' => true,
            ]);
        } else {
            $this->alert('error', 'Ha ocurrido un error.', [
                'position' => 'center',
                'timer' => '4000',
                'toast' => false,
                'timerProgressBar' => true,
                'text' => 'Este archivo no contiene un arreglo de objetos json.',
            ]);
        }
    }

    private function getUserEmail(array $user): String
    {
        $email = $this->createUserEmail($user);
        return $email;
    }

    private function createUserEmail(array $user): String
    {
        return strtolower($user['first_name'][0])
            . strtolower($user['first_name'][1])
            . strtolower($user['first_surname'])
            . substr($user['phone'], -2)
            . '@metrics.com';
    }

    private function getUserPassword(array $user): String
    {
        $password = $this->createUserPassword($user);
        return $password;
    }

    private function createUserPassword(array $user): String
    {
        return strtoupper($user['first_name'][0])
            . strtolower($user['first_name'][1])
            . strtoupper($user['first_surname'][0])
            . strtolower($user['first_surname'][1])
            . substr($user['phone'], -2)
            . '@2024';
    }
}
