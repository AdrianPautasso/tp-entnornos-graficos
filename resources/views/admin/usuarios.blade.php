@extends('layouts.app')

@section('content')


<div class="container-fluid">
    <div class="row">
        {{-- Sidebar Izquierda --}}
        <x-admin-sidebar/>
        

        {{-- Contenido Principal --}}
        
        <div class="col-md-9">
            <h2>Usuarios:</h2>
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Tipo de Usuario</th>
                        <th>Categoría Cliente</th>
                        <th>Aprobado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->id }}</td>
                            <td>{{ $usuario->nombre }}</td>
                            <td>{{ $usuario->email }}</td>
                            <td>
                                {{ $usuario->tipoUsuario->descripcion }}
                            </td>
                            <td>
                                @if ($usuario->idTipo == 3)
                                    {{ $usuario->categoria->descripcion }}                                    
                                @endif
                            </td>
                            <td>
                            @if ($usuario->idTipo == 2)
                                @if ($usuario->aprobado)
                                    ✅
                                @else
                                    ❌
                                @endif
                            @endif
                            </td>
                            
                            <td>
                                {{-- Ejemplo de acciones --}}


                                {{-- Aprobación solo si es dueño de local --}}
                                @if ($usuario->idTipo == 2 && ! $usuario->aprobado)
                                <button type="button"
                                    class="btn btn-sm btn-success"
                                    data-bs-toggle="modal"
                                    data-bs-target="#aprobarModal"
                                    data-usuario-id="{{ $usuario->id }}">
                                    Aprobar
                                </button>
                                @endif
                                @if ($usuario->idTipo == 2 && $usuario->aprobado)
                                    <form action="{{ route('usuarios.rechazar', $usuario->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-sm btn-danger">Rechazar</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="aprobarModal" tabindex="-1" aria-labelledby="aprobarModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" id="aprobarForm" >
        @csrf
        @method('PUT')
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="aprobarModalLabel">Aprobar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="idLocal" class="form-label">Seleccionar Local</label>
                    <select name="idLocal" id="idLocal" class="form-select" required>
                        <option value="">Seleccione un local</option>
                        @foreach ($locales_libres as $l)
                            <option value="{{ $l->id }}">{{ $l->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Aprobar</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </form>
  </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('aprobarModal');
        modal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const userId = button.getAttribute('data-usuario-id');
            const form = document.getElementById('aprobarForm');
            form.action = `/aprobar/usuarios/${userId}`;
        });
    });
</script>

@endsection