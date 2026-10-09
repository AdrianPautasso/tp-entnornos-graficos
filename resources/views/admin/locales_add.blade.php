@extends('layouts.app')

@section('title', 'Nuevo Local')

@section('content')

@php
$breadcrumbs = [
    [
        'title' => 'Locales',
        'url' => route('admin.locales')
    ],
    [
        'title' => 'Crear Local'
    ]
];
@endphp

<div class="row">
        {{-- Sidebar Izquierda --}}
        <x-admin-sidebar/>
        

        {{-- Contenido Principal --}}
        <div class="col-md-9">
            <h1>Nuevo Local</h1>
            
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('locales.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}" required>
                </div>

                <div class="mb-3">
                    <label for="ubicacion" class="form-label">Ubicación</label>
                    <input type="text" name="ubicacion" id="ubicacion" class="form-control" value="{{ old('ubicacion') }}" required>
                </div>

                <div class="mb-3">
                    <label for="rubro" class="form-label">Rubro</label>
                    <input type="text" name="rubro" id="rubro" class="form-control" value="{{ old('rubro') }}" required>
                </div>

                {{-- idUsuario oculto en null --}}
                <input type="hidden" name="idUsuario" value="">

                <div class="d-flex align-items-center gap-2">
            <button type="submit" class="btn btn-primary">Guardar Local</button>
            <a class="btn btn-outline-secondary" href="{{ route("admin.locales") }}">Cancelar</a>
            </div>
            </form>
        </div>

    </div>

@endsection



