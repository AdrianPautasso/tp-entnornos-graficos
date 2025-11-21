@extends('layouts.app')

@section('content')


<div class="container">

    <h2>Promociones Vigentes</h2>
    <div class="row">
        @forelse($promociones as $p)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $p->local->nombre }}</h5>
                        <p class="card-text">{{ $p->texto }}</p>
                        <p><strong>Válida hasta: </strong> {{ $p->fechaHasta }}</p>
                        <p><strong>Válida los días: </strong>{{ implode(", ",$p->diasSemana) }}</p>
                    </div>
                </div>
            </div>
        @empty
            <p>No hay promociones vigentes.</p>
        @endforelse
    </div>

    <hr>

    <h2>Novedades</h2>
    <ul>
        @forelse($novedades as $novedad)
            <li><strong>{{ $novedad->id }}</strong>: {{ $novedad->texto }}</li>
        @empty
            <p>No hay novedades actuales.</p>
        @endforelse
    </ul>


</div>


@endsection