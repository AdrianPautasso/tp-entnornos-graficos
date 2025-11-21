@extends('layouts.app')

@section('content')


<div class="container-fluid">
    <div class="row">
        {{-- Sidebar Izquierda --}}
        <x-admin-sidebar/>
        

        {{-- Contenido Principal --}}
        
        <div class="col-md-9">
            <h2>Locales:</h2>
            <a  class="btn btn-sm btn-success" style="margin-bottom: 10px" href="{{ route('admin.locales_add') }}">Agregar Local</a>
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Ubicación</th>
                        <th>Rubro</th>
                        <th>Promociones</th>
                        <th>Usuario</th>
                        <th>Acciones</th>                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($locales as $local)
                        <tr>
                            <td>{{ $local->id }}</td>
                            <td>{{ $local->nombre }}</td>
                            <td>{{ $local->ubicacion }}</td>
                            <td>{{ $local->rubro }}</td>
                            <td>
                              <a  class="nav-link">Ver Promociones</a>
                            </td>
                            <td>
                              {{ $local->usuario->usuario ?? ''}}
                            </td>
                            <td>
                              <a href="{{ route('admin.locales_edit', $local->id) }}" class="btn btn-sm btn-primary">Editar</a>

                                <form action="{{ route('locales.eliminar', $local->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que querés eliminar este local?')">Eliminar</button>
                                </form>

                              
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>

@if(session('success'))
    <div class="toast-container position-fixed bottom-0 start-50 translate-middle-x p-3" style="z-index: 1055;">
        <div id="successToast" class="toast align-items-center text-bg-success border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Cerrar"></button>
            </div>
        </div>
    </div>
@endif

@endsection
