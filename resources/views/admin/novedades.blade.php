@extends('layouts.app')

@section('content')


<div class="container-fluid">
    <div class="row">
        {{-- Sidebar Izquierda --}}
        <x-admin-sidebar/>
        

        {{-- Contenido Principal --}}
        
        <div class="col-md-9">
            <h2>Locales:</h2>
            <a  class="btn btn-sm btn-success" style="margin-bottom: 10px" href="{{ route('admin.novedades_add') }}">Agregar Novedad</a>
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Texto</th>
                        <th>Fecha Desde</th>
                        <th>Fecha Hasta</th>
                        <th>Categoria Mínima</th>
                        <th>Acciones</th>                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($novedades as $novedad)
                        <tr>
                            <td>{{ $novedad->id }}</td>
                            <td>{{ $novedad->texto }}</td>
                            <td>{{ $novedad->fechaDesde }}</td>
                            <td>{{ $novedad->fechaHasta }}</td>
                            <td>{{ $novedad->categoria->descripcion ?? ''}}</td>
                            <td>
                              <a href="{{ route('admin.novedades_edit', $novedad->id) }}" class="btn btn-sm btn-primary">Editar</a>

                                <form action="{{ route('novedades.eliminar', $novedad->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que querés eliminar esta novedad?')">Eliminar</button>
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
