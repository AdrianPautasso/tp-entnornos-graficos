@extends('layouts.app')

@section('content')

<div class="row">
        {{-- Sidebar Izquierda --}}
        <x-admin-sidebar/>
        

        {{-- Contenido Principal --}}
        <div class="col-md-9">
            <h1>Agregar Novedad</h1>
            
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('novedades.store') }}" method="POST">
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
                        <option value="">Seleccione una categoria</option>
                        @foreach ($categorias as $c)
                            <option value="{{ $c->id }}">{{ $c->descripcion }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Guardar Novedad</button>
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
