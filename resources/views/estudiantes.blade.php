@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Gestión de Estudiantes') }}</span>
                    <a href="{{ route('home') }}" class="btn btn-primary">Lista de Usuarios</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @auth
                    <h1>Lista de Estudiantes</h1>

                    <!-- Botón de agregar estudiante -->
                    @if (Auth::user()->hasRole('Administrador') || Auth::user()->hasRole('Director'))
                        <a href="{{ route('estudiantes.create') }}" class="btn btn-success mb-3">Agregar Estudiante</a>
                    @endif

                    <style>
                        table {
                            width: 100%;
                            border-collapse: collapse;
                            margin-top: 20px;
                        }

                        table, th, td {
                            border: 1px solid #ddd;
                        }

                        th, td {
                            padding: 12px;
                            text-align: left;
                        }

                        th {
                            background-color: #4CAF50;
                            color: white;
                        }

                        tr:nth-child(even) {
                            background-color: #f2f2f2;
                        }

                        tr:hover {
                            background-color: #ddd;
                        }

                        .alert {
                            margin-top: 20px;
                        }
                    </style>

                    <table>
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Celular</th>
                                <th>Correo</th>
                                <th>Programa</th>
                                <th>Semestre</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($estudiantes as $estudiante)
                            <tr>
                                <td>{{ $estudiante->nombre }}</td>
                                <td>{{ $estudiante->apellidos }}</td>
                                <td>{{ $estudiante->celular }}</td>
                                <td>{{ $estudiante->correo }}</td>
                                <td>{{ $estudiante->programa }}</td>
                                <td>{{ $estudiante->semestre }}</td>
                                <td>
                                    @if (Auth::user()->hasRole('Administrador'))
                                        <a href="{{ route('estudiantes.edit', $estudiante->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                        <form action="{{ route('estudiantes.destroy', $estudiante->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este estudiante?');">Eliminar</button>
                                        </form>
                                    @elseif (Auth::user()->hasRole('Director'))
                                        <a href="{{ route('estudiantes.edit', $estudiante->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                        <!-- No mostrar el botón de eliminar -->
                                    @elseif (Auth::user()->hasRole('Docente'))
                                        <span>Sin acciones disponibles</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @else
                    <div class="alert alert-warning">
                        Debes iniciar sesión para ver la lista de estudiantes.
                    </div>
                    @endauth

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
