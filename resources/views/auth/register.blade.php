@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Registro de Usuario</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre completo</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}" required>
        </div>

        <div class="mb-3">
            <label for="usuario" class="form-label">Nombre de usuario</label>
            <input type="text" name="usuario" id="usuario" class="form-control" value="{{ old('usuario') }}">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label for="idTipo" class="form-label">Tipo de Usuario</label>
            <select name="idTipo" id="idTipo" class="form-select" required>
                <option value="">Seleccione un tipo...</option>
                <option value="1" {{ old('idTipo') == 1 ? 'selected' : '' }}>Administrador</option>
                <option value="2" {{ old('idTipo') == 2 ? 'selected' : '' }}>Dueño de local</option>
                <option value="3" {{ old('idTipo') == 3 ? 'selected' : '' }}>Cliente</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Registrarse</button>
    </form>
</div>
@endsection
