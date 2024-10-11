<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash; 
use App\Models\User; // Asegúrate de incluir el modelo User

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Crear roles
        $adminRole = Role::create(['name' => 'Administrador']);
        $docenteRole = Role::create(['name' => 'Docente']);
        $directorRole = Role::create(['name' => 'Director']);

        // Crear permisos
        $permissions = [
            'add estudiantes',
            'edit estudiantes',
            'delete estudiantes',
            'view estudiantes',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Asignar permisos a roles
        $adminRole->givePermissionTo($permissions); // El admin tiene todos los permisos
        $docenteRole->givePermissionTo(['add estudiantes', 'edit estudiantes']); // Docente puede agregar y editar
        $directorRole->givePermissionTo('view estudiantes'); // Director solo puede ver

        // Crear el usuario Admin y asignarle el rol de Administrador
        $adminUser = User::create([
            'name' => 'Admin', // Nombre del usuario
            'email' => 'admin@example.com', // Correo electrónico del usuario
            'password' => Hash::make('12345678'), // Contraseña encriptada
        ]);

        // Asignar el rol de administrador al usuario creado
        $adminUser->assignRole($adminRole);
    }
}
