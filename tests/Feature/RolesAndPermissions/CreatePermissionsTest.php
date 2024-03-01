<?php

use Spatie\Permission\Models\Permission;

it('Crear Permisos', function () {

    // Arrange
    // ? Definición de Permisos
    $permissionsArray = [
        'calls create',
        'calls read',
        'calls update',
        'calls delete',
        'forms create',
        'forms read',
        'forms update',
        'forms delete',
        'hierarchies create',
        'hierarchies read',
        'hierarchies update',
        'hierarchies delete',
        'reports create',
        'reports read',
        'reports update',
        'reports delete',
        'users-capture-history show',
        'users create',
        'users read',
        'users update',
        'users delete',
    ];

    // Act
    // * Creación de Permisos
    foreach ($permissionsArray as $permissionName) {
        Permission::create(['name' => $permissionName]);
    }

    $allPermissions = Permission::all();

    // Assert
    expect($allPermissions)->each(
        fn ($permission) =>
        $permission->name->toBeIn($permissionsArray),
    );
});


it('Obtener Permisos', function () {
    // Arrange
    $permissions = Permission::all();

    // Act


    // Assert
    expect($permissions)->not->toBeEmpty();
});
