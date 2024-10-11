@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Editar Estudiante') }}</span>
                    <a href="{{ route('estudiantes') }}" class="btn btn-primary">Lista de Estudiantes</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @auth
                    <h1>Formulario para Editar Estudiante</h1>

                    <form action="{{ route('estudiantes.update', $estudiante->id) }}" method="POST">
                        @csrf
                        @method('PUT') <!-- Usar método PUT para la actualización -->
                        
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $estudiante->nombre) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="apellidos">Apellidos</label>
                            <input type="text" class="form-control" id="apellidos" name="apellidos" value="{{ old('apellidos', $estudiante->apellidos) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="celular">Celular</label>
                            <input type="text" class="form-control" id="celular" name="celular" value="{{ old('celular', $estudiante->celular) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="correo">Correo</label>
                            <input type="email" class="form-control" id="correo" name="correo" value="{{ old('correo', $estudiante->correo) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="programa">Programa</label>
                            <input type="text" class="form-control" id="programa" name="programa" value="{{ old('programa', $estudiante->programa) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="semestre">Semestre</label>
                            <input type="number" class="form-control" id="semestre" name="semestre" value="{{ old('semestre', $estudiante->semestre) }}" min="1" required>
                        </div>
                        <button type="submit" class="btn btn-success">Actualizar Estudiante</button>
                        <a href="{{ route('estudiantes') }}" class="btn btn-danger">Cancelar</a>
                    </form>

                    @if ($errors->any())
                        <div class="alert alert-danger mt-3">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @else
                    <div class="alert alert-warning">
                        Debes iniciar sesión para editar un estudiante.
                    </div>
                    @endauth

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
