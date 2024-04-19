<?php

namespace App\Livewire\Users;

use Exception;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Spatie\Permission\Models\Role;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class AddUsers extends Component
{
    use LivewireAlert;
    
    protected $listeners = [
        'confirmed'
    ];

    #[Validate('required|regex:/^[\pL\pM\s]+$/u|max:255', as: 'primer nombre')]
    public $firstName;
    #[Validate('nullable|regex:/^[\pL\pM\s]+$/u|max:255', as: 'segundo nombre')]
    public $secondName;
    #[Validate('required|regex:/^[\pL\pM\s]+$/u|max:255', as: 'primer apellido')]
    public $firstSurName;
    #[Validate('nullable|regex:/^[\pL\pM\s]+$/u|max:255', as: 'segundo apellido')]
    public $secondSurName;
    #[Validate('required|numeric|digits:10', as: 'teléfono')]
    public $phone;
    #[Validate('required', as: 'rol')]
    public $selectedRole;

    public $email, $password;

    public function render()
    {
        return view('livewire.users.add-users', [
            'roles' => Role::all()->except([1]),
        ]);
    }

    public function save()
    {
        $this->confirm('¿Deseas agregar este usuario?', [
            'confirmButtonText' => 'Si',
            'onConfirmed' => 'confirmed',
            'allowOutsideClick' => false,
        ]);
    }

    public function confirmed()
    {
        $this->validate();
        $this->trimVariables();
        $this->generateEmail($this->firstName, $this->firstSurName, $this->phone);

        $search = User::where('email', $this->email)->first();
        if (!$search) {
            $this->generateUserPassword($this->firstName, $this->firstSurName, $this->phone);

            try {
                $new_user = User::create([
                    "name" => $this->generateFullName(),
                    "email" => $this->email,
                    "phone" => $this->phone,
                    "password" => bcrypt($this->password),
                ]);

                $new_user->assignRole($this->selectedRole);

                $this->alert('success', 'Usuario agregado', [
                    'position' => 'center',
                    'timer' => '2000',
                    'toast' => false,
                    'timerProgressBar' => true,
                ]);
            } catch (Exception $err) {
                $this->alert('error', 'Ha ocurrido un error.', [
                    'position' => 'center',
                    'timer' => '4000',
                    'toast' => false,
                    'timerProgressBar' => true,
                    'text' => 'Intentelo de nuevo',
                ]);
            }
        } else {
            $this->alert('error', 'Usuario duplicado.', [
                'position' => 'center',
                'timer' => '4000',
                'toast' => false,
                'timerProgressBar' => true,
                'text' => 'Este usuario ya existe.',
            ]);
        }
    }

    public function trimVariables(): void
    {
        $this->firstName = trim($this->firstName);
        $this->secondName = trim($this->secondName);
        $this->firstSurName = trim($this->firstSurName);
        $this->secondSurName = trim($this->secondSurName);
        $this->phone = trim($this->phone);
    }

    public function generateEmail($firstName, $firstSurName, $phone)
    {
        if ($firstName && $firstSurName && $phone) {
            $this->email = strtolower($firstName[0])
                . strtolower($firstName[1])
                . strtolower($firstSurName)
                . substr($phone, -2)
                . '@metrics.com';
        }
    }

    public function generateUserPassword($firstName, $firstSurName, $phone)
    {
        $this->password = strtoupper($firstName[0])
            . strtolower($firstName[1])
            . strtoupper($firstSurName[0])
            . strtolower($firstSurName[1])
            . substr($phone, -2)
            . '@2024';
    }

    public function generateFullName(): string
    {
        $names_array = array();

        array_push($names_array, trim($this->firstName));
        trim($this->secondName) ? array_push($names_array, trim($this->secondName)) : '';
        array_push($names_array, trim($this->firstSurName));
        trim($this->secondSurName) ? array_push($names_array, trim($this->secondSurName)) : '';

        return implode(' ', $names_array);
    }

    public function redirectToPanel()
    {
        return redirect()->route('panel-usuarios');
    }
}
