<?php

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Gate;

beforeEach(function () {
    $this->permissionsArray = [
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

    $users = User::all();

    foreach ($users as $user) {
        $user->delete();
    }

    $this->user = User::create([
        'name' => 'Marco Zacarias',
        'email' => 'mazacarias45@metrics.test',
        'password' => bcrypt('MaZa45@2024'),
    ]);
});



describe('Revision de permisos por Rol', function () {

    it('Creación de Usuario Super Administrator', function () {
        // Arrange
        $superAdmin = $this->user;
        // Act
        $superAdmin->assignRole('Super Administrator');

        // Assert
        expect($superAdmin->name)->toBe('Marco Zacarias');
    });


    it('Revisión de permisos de Super Administrator', function () {
        // Arrange
        $superAdmin = $this->user;

        // Act 
        $superAdmin->assignRole('Super Administrator');

        // Assert
        foreach ($this->permissionsArray as $permission) {
            $this->assertTrue(Gate::forUser($superAdmin)->allows($permission));
        }
    });


    it('Asignación de permisos a rol Administrator', function () {

        // Arrange
        $administrator = Role::where('name', 'Administrator')
            ->first();

        $permissions = array_filter($this->permissionsArray, function ($permission) {
            return strpos($permission, 'calls') !== false ||
                strpos($permission, 'forms read') !== false ||
                strpos($permission, 'forms delete') !== false ||
                strpos($permission, 'hierarchies') !== false ||
                strpos($permission, 'reports') !== false ||
                strpos($permission, 'users-capture-history show') !== false;
        });


        // Act
        $administrator->syncPermissions($permissions);

        // Assert
        expect($administrator)->not()->toBeEmpty();
        expect($administrator->permissions)->not()->toBeEmpty();
        expect($administrator->permissions->pluck('name')->toArray())->toEqualCanonicalizing($permissions);
    });

    it('Asignación de permisos a rol Supervisor', function () {

        // Arrange
        $supervisor = Role::where('name', 'Supervisor')
            ->first();

        $permissions = array_filter($this->permissionsArray, function ($permission) {
            return strpos($permission, 'calls') !== false ||
                strpos($permission, 'forms read') !== false ||
                strpos($permission, 'forms delete') !== false ||
                strpos($permission, 'reports') !== false ||
                strpos($permission, 'users-capture-history show') !== false;
        });


        // Act
        $supervisor->syncPermissions($permissions);

        // Assert
        expect($supervisor)->not()->toBeEmpty();
        expect($supervisor->permissions)->not()->toBeEmpty();
        expect($supervisor->permissions->pluck('name')->toArray())->toEqualCanonicalizing($permissions);
    });

    it('Asignación de permisos a rol Capture Analyst', function () {

        // Arrange
        $captureAnalyst = Role::where('name', 'Capture Analyst')
            ->first();

        $permissions = array_filter($this->permissionsArray, function ($permission) {
            return strpos($permission, 'forms read') !== false ||
                strpos($permission, 'forms delete') !== false ||
                strpos($permission, 'users-capture-history show') !== false;
        });


        // Act
        $captureAnalyst->syncPermissions($permissions);

        // Assert
        expect($captureAnalyst)->not()->toBeEmpty();
        expect($captureAnalyst->permissions)->not()->toBeEmpty();
        expect($captureAnalyst->permissions->pluck('name')->toArray())->toEqualCanonicalizing($permissions);
    });

    it('Asignación de permisos a rol Data Capturer', function () {

        // Arrange
        $dataCapturer = Role::where('name', 'Data Capturer')
            ->first();

        $permissions = array_filter($this->permissionsArray, function ($permission) {
            return strpos($permission, 'forms read') !== false ||
                strpos($permission, 'forms delete') !== false ||
                strpos($permission, 'users-capture-history show') !== false;
        });


        // Act
        $dataCapturer->syncPermissions($permissions);

        // Assert
        expect($dataCapturer)->not()->toBeEmpty();
        expect($dataCapturer->permissions)->not()->toBeEmpty();
        expect($dataCapturer->permissions->pluck('name')->toArray())->toEqualCanonicalizing($permissions);
    });
});
