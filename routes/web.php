<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EstudianteController;

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/home', [UserController::class, 'index'])->name('home');

// Asignar un rol a un usuario
Route::post('/assign-role/{id}', [UserController::class, 'assignRole'])->name('assign.role');

// Eliminar un rol de un usuario
Route::post('/remove-role/{id}', [UserController::class, 'removeRole'])->name('remove.role');



Route::get('/estudiantes', [EstudianteController::class, 'index'])->name('estudiantes');
Route::get('/estudiantes/create', [EstudianteController::class, 'create'])->name('estudiantes.create');
Route::post('/estudiantes', [EstudianteController::class, 'store'])->name('estudiantes.store');
Route::get('/estudiantes/{estudiante}/edit', [EstudianteController::class, 'edit'])->name('estudiantes.edit');
Route::put('/estudiantes/{estudiante}', [EstudianteController::class, 'update'])->name('estudiantes.update');
Route::delete('/estudiantes/{estudiante}', [EstudianteController::class, 'destroy'])->name('estudiantes.destroy');
