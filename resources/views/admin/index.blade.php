@extends('layouts.app')

@section('title', 'Panel de Administrador')

@section('content')

<div class="container-fluid">
    <div class="row">
        {{-- Sidebar Izquierda --}}
        <x-admin-sidebar/>
        

        {{-- Contenido Principal --}}
        <div class="col-md-9">
            <h1>Bienvenido, {{ auth()->user()->nombre }}</h1>

            <div class="container-fluid">
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <div class="card h-100 text-center">
                            <div class="card-body d-flex flex-column justify-content-center">
                                <h2>{{ $cantidadLocales }}</h2>
                                <p class="mb-0">Locales</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card h-100 text-center">
                            <div class="card-body d-flex flex-column justify-content-center">
                                <h2>{{ $cantidadUsuarios }}</h2>
                                <p class="mb-0">Usuarios</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card h-100 text-center">
                            <div class="card-body d-flex flex-column justify-content-center">
                                <h2>{{ $cantidadPromociones }}</h2>
                                <p class="mb-0">Promociones</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card h-100 text-center">
                            <div class="card-body d-flex flex-column justify-content-center">
                                <h2>{{ $cantidadNovedades }}</h2>
                                <p class="mb-0">Novedades</p>
                            </div>
                        </div>
                    </div>
            </div>

        </div>

    </div>

    </div>
</div>

@endsection