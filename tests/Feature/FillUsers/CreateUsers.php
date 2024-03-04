<?php

use App\Models\User;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    //...
    $this->json = Storage::json('fill.json');
});


it('Obtener archivo fill.json como arreglo asociativo', function () {
    $json = $this->json;
    expect($json)->toBeArray();
});

it('Crear correo a partir de un archivo fill.json', function () {
    $users = $this->json;
    $email = getUserEmail($users[0]);
    expect($email)->toBe('mazacarias45@metrics.test');
});

it('Crear contraseña a partir de un archivo fill.json', function () {
    $users = $this->json;
    $password = getUserPassword($users[0]);
    expect($password)->toBe('MaZa45@2024');
});

it('Crear usuarios a partir de archivo fill.json', function () {
    // Arrange
    $users = $this->json;

    foreach ($users as $user) {
        $email = getUserEmail($user);
        $password = getUserPassword($user);
        try {
            User::create([
                "name" => $user['full_name'],
                "email" => $email,
                "phone" => $user['phone'],
                "password" => bcrypt($password),
            ]);
        } catch (Exception $err) {
        }
    }

    // Act
    $user = User::where('email', 'mazacarias45@metrics.test')->first();
    // Assert
    expect($user)->not->toBeNull();
    expect($users[0]['full_name'])->toBe($user->name);
});

it('Asignar rol a usuario', function () {
    // Arrange
    $userToAsignRole = User::where('email', 'mazacarias45@metrics.test')->first();

    // Act
    $userToAsignRole->assignRole('Super Administrator');

    $userWithRole = User::where('email', 'mazacarias45@metrics.test')
        ->whereHas('roles', function ($query) {
            $query->where('name', 'Super Administrator');
        })
        ->first();
    // Assert
    expect($userWithRole)->not->toBeNull();
});


function getUserEmail(array $user): String
{
    $email = createUserEmail($user);
    return $email;
}

function createUserEmail(array $user): String
{
    return strtolower($user['first_name'][0])
        . strtolower($user['first_name'][1])
        . strtolower($user['first_surname'])
        . substr($user['phone'], -2)
        . '@metrics.test';
}

function getUserPassword(array $user): String
{
    $password = createUserPassword($user);
    return $password;
}

function createUserPassword(array $user): String
{
    return strtoupper($user['first_name'][0])
        . strtolower($user['first_name'][1])
        . strtoupper($user['first_surname'][0])
        . strtolower($user['first_surname'][1])
        . substr($user['phone'], -2)
        . '@2024';
}
