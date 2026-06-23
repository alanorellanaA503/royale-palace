<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder {
    public function run(): void {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permisos = [
            'gestionar-reservaciones',
            'gestionar-mesas',
            'gestionar-platos',
            'gestionar-usuarios',
            'gestionar-sedes',
            'generar-reportes',
        ];

        foreach ($permisos as $permiso) {
            Permission::firstOrCreate(['name' => $permiso]);
        }

        // Solo dos roles: admin general y usuario
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->syncPermissions(Permission::all());

        Role::firstOrCreate(['name' => 'usuario']);
    }
}