@extends('layouts.app')

@section('title', 'Promociones')

@section('content')

@php
$breadcrumbs = [
    [
        'title' => 'Promociones',
    ]
];
@endphp


<div class="container">

    <h2>Promociones Vigentes</h2>

    <p class="text-muted">
        Listado de consulta pública. Registrate para poder usar las promociones.
    </p>

    <div class="row">
        @forelse($promociones as $p)
            <div class="col-md-4 mb-3">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $p->local->nombre }}</h5>
                        <p class="card-text">{{ $p->texto }}</p>
                        <p><strong>Válida hasta: </strong> {{ $p->fechaHasta }}</p>
                        <p><strong>Válida los días: </strong>{{ implode(", ", $p->diasSemana) }}</p>
                    </div>
                </div>
            </div>
        @empty
            <p>No hay promociones vigentes.</p>
        @endforelse
    </div>

    <a href="{{ route('register') }}" class="btn btn-primary">Registrarse para usar las promociones</a>

</div>

@endsection