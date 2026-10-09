@extends('layouts.app')

@section('title', 'Inicio')

@section('content')


<div class="container">

    {{-- Hero institucional --}}
    <section class="text-center py-5">
        <h1 class="display-4 fw-bold">Shopping Rosario</h1>
        <p class="lead mx-auto mt-3" style="max-width: 700px;">
            Somos el centro comercial de la ciudad. Te acercamos los locales, las promociones
            y las novedades del shopping en un solo lugar.
        </p>
        <p class="text-muted">
            Bv. Rondeau 1234, Rosario, Santa Fe
        </p>

        <div class="mt-4">
            <a href="{{ route('promociones') }}" class="btn btn-primary btn-lg me-2">Ver promociones</a>
            <a href="{{ route('sobreShopping') }}" class="btn btn-outline-primary btn-lg me-2">Sobre el shopping</a>
            <a href="{{ route('faq') }}" class="btn btn-outline-primary btn-lg me-2">Preguntas frecuentes</a>
            <a href="{{ route('contacto') }}" class="btn btn-outline-primary btn-lg">Contacto</a>
        </div>
    </section>

    {{-- Promociones --}}
    <section id="promociones">
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
    </section>

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