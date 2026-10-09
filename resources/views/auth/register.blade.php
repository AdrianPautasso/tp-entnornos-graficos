@extends('layouts.app')

@section('title', 'Registrarse')

@section('content')
<div class="container">
    <h2>Registro de Usuario</h2>

    <div class="alert alert-info" role="status">
        Podés registrarte como <strong>cliente</strong> o como <strong>dueño de un local</strong>.
        Si te registrás como dueño, tu cuenta queda en estado <strong>Pendiente</strong> y un
        administrador debe aprobarla antes de que puedas iniciar sesión.
    </div>

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
            <input type="text" name="usuario" id="usuario" class="form-control" value="{{ old('usuario') }}" required>
            @error('usuario') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label for="idTipo" class="form-label">Tipo de Usuario</label>
            <select name="idTipo" id="idTipo" class="form-select" required
                    data-dueno-id="{{ $idDueño }}">
                <option value="">Seleccione un tipo...</option>

                @foreach($tipos as $tipo)
                    <option value="{{ $tipo->id }}" {{ old('idTipo') == $tipo->id ? 'selected' : '' }}>
                        {{ $tipo->descripcion }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Campo idLocal (visible solo si es dueño de local) -->
        <!-- El servidor decide el estado inicial (para funcionar sin JS y para no perder
             la selección al volver con errores) y el script lo ajusta al cambiar el tipo. -->
        <div class="mb-3" id="showLocal" @if (old('idTipo') != $idDueño) hidden @endif>
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
            // El id del dueño llega en data-dueno-id: no se hardcodea el 2.
            local.hidden = tipoSelect.value != tipoSelect.dataset.duenoId;
        }

        tipoSelect.addEventListener('change', toggleidLocal);
        toggleidLocal(); // sincroniza al cargar la página
    });
</script>

@endsection
