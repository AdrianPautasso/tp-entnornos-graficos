@extends('layouts.app')

@section('title', 'Agregar Promoción')

@section('content')

@php
$breadcrumbs = [
    [
        'title' => 'Promociones',
        'url' => route('promociones')
    ],
    [
        'title' => 'Crear promoción'
    ]
];
@endphp

<div class="row">
        {{-- Sidebar Izquierda --}}
        <x-dueno-sidebar/>
        

        {{-- Contenido Principal --}}
        <div class="col-md-9">
            <h1>Agregar Promocion</h1>
            
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('promociones.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="nombre" class="form-label">Texto</label>
                    <input type="text" name="texto" id="texto" class="form-control" value="{{ old('texto') }}" required>
                </div>

                <div class="mb-3">
                    <label for="fechaDesde" class="form-label">Fecha Desde</label>
                    <input type="date" id="fechaDesde" name="fechaDesde" class="form-control" value="{{ old('fechaDesde') }}" required>
                </div>

                <div class="mb-3">
                    <label for="fechaHasta" class="form-label">Fecha Hasta</label>
                    <input type="date" id="fechaHasta" name="fechaHasta" class="form-control" value="{{ old('fechaHasta') }}" required>
                </div>

                <div class="mb-3">
                    <label for="idCategoriaMinima" class="form-label">Seleccionar Categoria</label>
                    <select name="idCategoriaMinima" id="idCategoriaMinima" class="form-select" required>
                        <option value="">Seleccione una categoria minima</option>
                        @foreach ($categorias as $c)
                            <option value="{{ $c->id }}">{{ $c->descripcion }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Días de la semana</label><br>
                    @php
                        $dias = ["Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado", "Domingo"];
                    @endphp
                    @foreach ($dias as $dia)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="diasSemana[]" value="{{ $dia }}" id="{{ $dia }}">
                            <label class="form-check-label" for="{{ $dia }}">{{ $dia }}</label>
                        </div>
                    @endforeach
                </div>
                
                <div class="mb-3">
                    <label for="idLocal" class="form-label">Seleccionar Local</label>
                    <select name="idLocal" id="idLocal" class="form-select" required>
                        <option value="">Seleccione un local</option>
                        @foreach ($locales as $l)
                            <option value="{{ $l->id }}">{{ $l->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex align-items-center gap-2">
    <button type="submit" class="btn btn-primary">Guardar Promocion</button>
    <a class="btn btn-outline-secondary ms-2" href="{{ route('promociones') }}">Cancelar</a>
</div>
            </form>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const fechaDesde = document.getElementById('fechaDesde');
            const fechaHasta = document.getElementById('fechaHasta');

            fechaDesde.addEventListener('change', function () {
                if (fechaDesde.value) {
                    fechaHasta.min = fechaDesde.value;
                    if (fechaHasta.value && fechaHasta.value < fechaDesde.value) {
                        fechaHasta.value = '';
                    }
                }
            });
        });
    </script>
@endsection
