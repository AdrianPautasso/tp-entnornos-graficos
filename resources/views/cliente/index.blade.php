@extends('layouts.app')

@section('content')



<div class="container">

    <h2>Cliente</h2>
    <h3>Funciones</h3>
    <ul>
        <li style="text-decoration:line-through;">Registrarse en el sistema para acceder a las ofertas del shopping.</li>
        <li style="text-decoration:line-through;">Buscar promociones en los locales del shopping.</li>
        <li style="text-decoration:line-through;">Ingresar el código de un local y elegir una promocion disponible.</li>
        <li style="text-decoration:line-through;">No mostrar las promociones utilizadas en el listado de promociones disponibles.</li>
        <li style="text-decoration:line-through;">Ver las novedades del shopping.</li>
    </ul>


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
            <li><strong>{{ $novedad->id }}</strong>: {{ $novedad->texto }}</li>
        @empty
            <p>No hay novedades actuales.</p>
        @endforelse
    </ul>


</div>




@endsection