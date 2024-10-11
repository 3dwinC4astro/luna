<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Muestra la lista de usuarios
    public function index()
    {
        $users = User::with('roles')->get();
        $roles = Role::all();
     


        return view('home', compact('users', 'roles'));
    }

    // Asigna un rol a un usuario
    public function assignRole(Request $request, $id)
    {
        if (!auth()->user()->hasRole('Administrador')) {
            return redirect()->back()->with('error', 'No tienes permiso para realizar esta acción.');
        }
        
        $user = User::findOrFail($id);
        $role = Role::findOrFail($request->role_id);

        if ($user->hasRole($role->name)) {
            return redirect()->back()->with('error', 'El usuario ya tiene este rol.');
        }

        $user->assignRole($role);

        return redirect()->back()->with('success', 'Rol asignado correctamente.');
    }

    // Elimina un rol de un usuario
    public function removeRole(Request $request, $id)
    {
        if (!auth()->user()->hasRole('Administrador')) {
            return redirect()->back()->with('error', 'No tienes permiso para realizar esta acción.');
        }
        
        $user = User::findOrFail($id);
        $role = Role::findOrFail($request->role_id);

        if (!$user->hasRole($role->name)) {
            return redirect()->back()->with('error', 'El usuario no tiene este rol.');
        }

        $user->removeRole($role);

        return redirect()->back()->with('success', 'Rol eliminado correctamente.');
    }
}
