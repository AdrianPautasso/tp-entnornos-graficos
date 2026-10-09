@extends('layouts.app')

@section('title', 'Editar Local')

@section('content')

@php
$breadcrumbs = [
    [
        'title' => 'Locales',
        'url' => route('admin.locales')
    ],
    [
        'title' => 'Editar Local'
    ]
];
@endphp

<div class="row">
        {{-- Sidebar Izquierda --}}
        <x-admin-sidebar/>
        

        {{-- Contenido Principal --}}
        <div class="col-md-9">
            <h1>Editar Local</h1>


        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('locales.update', $local) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $local->nombre) }}" required>
            </div>

            <div class="mb-3">
                <label for="ubicacion" class="form-label">Ubicación</label>
                <input type="text" name="ubicacion" id="ubicacion" class="form-control" value="{{ old('ubicacion', $local->ubicacion) }}" required>
            </div>

            <div class="mb-3">
                <label for="rubro" class="form-label">Rubro</label>
                <input type="text" name="rubro" id="rubro" class="form-control" value="{{ old('rubro', $local->rubro) }}" required>
            </div>

            {{-- idUsuario no se edita desde este formulario --}}
            <input type="hidden" name="idUsuario" value="{{ $local->idUsuario }}">

            <div class="d-flex align-items-center gap-2">
            <button type="submit" class="btn btn-primary">Actualizar Local</button>
            <a class="btn btn-outline-secondary" href="{{ route("admin.locales") }}">Cancelar</a>
            </div>
        </form>
    </div>
@endsection