@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        {{-- Sidebar Izquierda --}}
        <x-admin-sidebar/>
        

        {{-- Contenido Principal --}}
        
        <div class="col-md-9">
            <h2>Promociones:</h2>

            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Comercio</th>
                        <th>ID</th>
                        <th>Texto</th>
                        <th>Fecha Desde</th>
                        <th>Fecha Hasta</th>
                        <th>Categoria Minima</th>
                        <th>Estado</th>
                        <th>Dias Semana</th>
                        <th>Acciones</th>                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($promociones as $p)
                        <tr>
                            <td>{{ $p->local->nombre }}</td>
                            <td>{{ $p->id }}</td>
                            <td>{{ $p->texto }}</td>
                            <td>{{ $p->fechaDesde }}</td>
                            <td>{{ $p->fechaHasta }}</td>
                            <td>{{ $p->categoriaMinima->descripcion }}</td>
                            <td>{{ $p->estado }}</td>
                            <td>{{ implode(", ",$p->diasSemana) }}</td>
                            <td>
                                <form action="{{ route('promociones.aprobar', $p) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="estado" value="Aprobada">
                                        <button class="btn btn-sm btn-success">Aprobar</button>
                                </form>
                                <form action="{{ route('promociones.denegar', $p) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="estado" value="Denegada">
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que querés denegar esta promoción?')">Denegar</button>
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
