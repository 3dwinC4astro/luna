<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Models\Estudiante;

class EstudianteController extends Controller
{
public function index()
{
    $estudiantes = Estudiante::all();
    return view('estudiantes', compact('estudiantes'));
}

public function create()
{
    return view('estudiantes.create');
}

public function store(Request $request)
{
    $validated = $request->validate([
        'nombre' => 'required|string|max:255',
        'apellidos' => 'required|string|max:255',
        'celular' => 'required|string|max:15',
        'correo' => 'required|string|email|max:255|unique:estudiantes',
        'programa' => 'required|string|max:255',
        'semestre' => 'required|integer',
    ]);

    Estudiante::create($validated);
    return redirect()->route('estudiantes')->with('success', 'Estudiante creado con éxito.');
}

public function edit($id)
{
    $estudiante = Estudiante::findOrFail($id);
    return view('estudiantes.edit', compact('estudiante'));
}

public function update(Request $request, $id)
{
    $validated = $request->validate([
        'nombre' => 'required|string|max:255',
        'apellidos' => 'required|string|max:255',
        'celular' => 'required|string|max:15',
        'correo' => 'required|string|email|max:255',
        'programa' => 'required|string|max:255',
        'semestre' => 'required|integer',
    ]);

    $estudiante = Estudiante::findOrFail($id);
    $estudiante->update($validated);
    return redirect()->back()->with('success', 'Estudiante actualizado con éxito.');
}

public function destroy($id)
{
    $estudiante = Estudiante::findOrFail($id);
    $estudiante->delete();
    return redirect()->back()->with('success', 'Estudiante eliminado con éxito.');
}
}
