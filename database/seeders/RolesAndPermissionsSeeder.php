<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // * Definición de roles
        $rolesArray = [
            'Super Administrator',
            'Administrator',
            'Supervisor',
            'Capture Analyst',
            'Data Capturer',
        ];
        // * Definición de permisos
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

        // * Creación de roles
        foreach ($rolesArray as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
        }

        // * Creación de permisos
        foreach ($permissionsArray as $permissionName) {
            Permission::firstOrCreate(['name' => $permissionName]);
        }

        // * Asignación de permisos a roles
        // ? Administrator
        $administratorRole = Role::where('name', 'Administrator')->first();
        $administratorPermissions = array_filter($permissionsArray, function ($permission) {
            return strpos($permission, 'calls') !== false ||
                strpos($permission, 'forms create') !== false ||
                strpos($permission, 'forms read') !== false ||
                strpos($permission, 'forms delete') !== false ||
                strpos($permission, 'hierarchies') !== false ||
                strpos($permission, 'reports') !== false ||
                strpos($permission, 'users-capture-history show') !== false;
        });
        $administratorRole->syncPermissions($administratorPermissions);

        // ? Supervisor
        $supervisorRole = Role::where('name', 'Supervisor')->first();
        $supervisorPermissions = array_filter($permissionsArray, function ($permission) {
            return strpos($permission, 'calls') !== false ||
                strpos($permission, 'forms create') !== false ||
                strpos($permission, 'forms read') !== false ||
                strpos($permission, 'forms delete') !== false ||
                strpos($permission, 'reports') !== false ||
                strpos($permission, 'users-capture-history show') !== false;
        });
        $supervisorRole->syncPermissions($supervisorPermissions);

        // ? Capture Anlyst
        $captureAnalystRole = Role::where('name', 'Capture Analyst')->first();
        $captureAnalystPermissions = array_filter($permissionsArray, function ($permission) {
            return strpos($permission, 'forms create') !== false ||
                strpos($permission, 'forms read') !== false ||
                strpos($permission, 'forms delete') !== false ||
                strpos($permission, 'users-capture-history show') !== false;
        });
        $captureAnalystRole->syncPermissions($captureAnalystPermissions);

        // ? Data Capturer 
        $dataCapturerRole = Role::where('name', 'Data Capturer')->first();
        $dataCapturerPermissions = array_filter($permissionsArray, function ($permission) {
            return strpos($permission, 'forms create') !== false ||
                strpos($permission, 'forms read') !== false;
        });
        $dataCapturerRole->syncPermissions($dataCapturerPermissions);
    }
}
