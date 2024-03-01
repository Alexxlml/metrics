<?php

use Spatie\Permission\Models\Role;

it('Crear Roles', function () {

    // Arrange
    // ? Definición de Roles
    $rolesArray = [
        'Super Administrator',
        'Administrator',
        'Supervisor',
        'Capture Analyst',
        'Data Capturer',
    ];

    // Act
    // * Creación de Roles
    foreach ($rolesArray as $roleName) {
        Role::create(['name' => $roleName]);
    }

    $allRoles = Role::all();

    // Assert
    expect($allRoles)->each(
        fn ($role) =>
        $role->name->toBeIn($rolesArray),
    );
});


it('Obtener Roles', function () {
    // Arrange
    $roles = Role::all();

    // Act


    // Assert
    expect($roles)->not->toBeEmpty();
});
