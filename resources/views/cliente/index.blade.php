@extends('layouts.app')

@section('content')



<div class="container">

    <h2>Cliente</h2>
    <h3>Funciones</h3>
    <ul>
        <li>✓️ Registrarse en el sistema para acceder a las ofertas del shopping.</li>
        <li>Buscar descuentos en los locales del shopping.</li>
        <li>Ingresar el código de un local y elegir un descuento disponible.</li>
        <li>✓️ Ver las novedades del shopping.</li>
    </ul>


    <h2>Promociones Vigentes</h2>
    <div class="row">
        @forelse($promociones as $p)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $p->id }}</h5>
                        <p class="card-text">{{ $p->texto }}</p>
                        <p><strong>Válida hasta: </strong> {{ $p->fechaHasta }}</p>
                        <p><strong>Válida los días: </strong>{{ str_replace(',', ', ',preg_replace('/["\[\]]/', '', $p->diasSemana)); }}</p>
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