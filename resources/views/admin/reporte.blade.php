@extends('layouts.app')

@section('title', 'Reporte de Uso de Promociones')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Reporte de Uso de Promociones</h1>

    <form method="GET" action="{{ route('admin.reporte') }}" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <label>Desde:</label>
                <input type="date" name="fecha_desde" class="form-control" value="{{ old('fecha_desde', request('fecha_desde')) }}"">
            </div>

            <div class="col-md-4">
                <label>Hasta:</label>
                <input type="date" name="fecha_hasta" class="form-control" value="{{ old('fecha_hasta', request('fecha_hasta')) }}">
            </div>

            <div class="col-md-4 d-flex align-items-end">
                <button class="btn btn-primary w-100">Filtrar</button>
            </div>
        </div>
    </form>

    <table class="table table-striped table-bordered mt-3">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Promoción</th>
                <th>Local</th>
                <th>Fecha de Uso</th>
                <th>Estado</th>
                <th>Fecha Registro</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reporte as $uso)
            <tr>
                <td>{{ $uso->id }}</td>
                <td>{{ $uso->usuario->nombre ?? '---' }}</td>
                <td>{{ $uso->promocion->texto ?? '---' }}</td>
                <td>{{ $uso->promocion->local->nombre ?? '---' }}</td>
                <td>{{ $uso->fechaUso }}</td>
                <td>
                    @if($uso->estado === 'Aceptada')
                        <span class="badge bg-success">Aceptada</span>
                    @elseif($uso->estado === 'Rechazada')
                        <span class="badge bg-danger">Rechazada</span>
                    @else
                        <span class="badge bg-secondary">{{ $uso->estado }}</span>
                    @endif
                </td>
                <td>{{ $uso->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Paginación --}}
    <div class="d-flex justify-content-center">
        {{ $reporte->links() }}
    </div>
</div>
@endsection
