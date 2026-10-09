@extends('layouts.app')

@section('title', 'Panel de Cliente')

@section('content')



<div class="container">

    <h2>Cliente</h2>
    <h2>Promociones Vigentes</h2>
    <div class="row"> 
        @forelse($promociones->take(2) as $p)
            <div class="col-md-4 mb-3">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $p->id }}</h5>
                        <p class="card-text">{{ $p->texto }}</p>
                        <p><strong>Válida hasta: </strong> {{ $p->fechaHasta }}</p>
                        <p><strong>Válida los días: </strong>{{ implode(", ",$p->diasSemana) }}</p>
                    </div>
                </div>
            </div>
        @empty
            <p>No hay promociones vigentes.</p>
        @endforelse
        @if(isset($promociones))
            <div class="col-md-4 mb-3">
                <div class="card h-100">
                    <div class="card-body d-flex justify-content-center align-items-center">
                        <a href="{{ route('promociones') }}">Ver todas</a>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <hr>

    <h2>Novedades</h2>
    <ul>
        @forelse($novedades as $novedad)
            <li>{{ $novedad->texto }}</li>
        @empty
            <p>No hay novedades actuales.</p>
        @endforelse
    </ul>


</div>




@endsection