@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Registro de Usuario</h2>

    <h3>Correcciones</h3>
    <ul>
        <li>Registrar solo clientes y dueños.</li>
        <li>Al dueño, setear estado = Pendiente</li>
    </ul>

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

                @foreach($tipos as $tipo)
                    <option value="{{ $tipo->id }}" {{ old('idTipo') == $tipo->id ? 'selected' : '' }}>
                        {{ $tipo->descripcion }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Campo idLocal (visible solo si es dueño de local) -->
        <div class="mb-3" id="showLocal" style="display: none;">
            <label for="idLocal" class="form-label">Local asignado</label>
            <select name="idLocal" id="idLocal" class="form-select">
                <option value="">Seleccione un local...</option>
                @foreach($locales as $local)
                    <option value="{{ $local->id }}" {{ old('idLocal') == $local->id ? 'selected' : '' }}>
                        {{ $local->nombre }}
                    </option>
                @endforeach
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tipoSelect = document.getElementById('idTipo');
        const local = document.getElementById('showLocal');
        
        function toggleidLocal() {
            local.style.display = tipoSelect.value == 2 ? 'block' : 'none';
        }

        tipoSelect.addEventListener('change', toggleidLocal);
        //toggleidLocal(); // ejecutar al cargar la página
    });
</script>

@endsection
