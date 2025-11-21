@extends('layouts.app')

@section('content')

<div class="container-fluid">
  <div class="row">

    {{-- Sidebar Izquierda --}}
    <x-dueno-sidebar/>

    {{-- Contenido Principal --}}
    <div class="col-md-9">
      @foreach($locales as $local)
          <h2>Local: {{ $local['nombre'] }}</h2>
          <p>Ubicación: {{ $local['ubicacion'] }}</p>
          <ul>
              @php
                  $promocionesDelLocal = collect($promociones)->filter(function($promocion) use ($local) {
                      return $promocion['idLocal'] === $local['id'];
                  });
              @endphp

              @if($promocionesDelLocal->isEmpty())
                  <li>No hay promociones disponibles para este local.</li>
              @else
                  @foreach($promocionesDelLocal as $promocion)
                      <li>
                          <strong>Promoción:</strong> {{ $promocion['texto'] }}
                          <br>
                          <strong>Estado:</strong> {{ $promocion['estado'] }}
                          <br>
                          <strong>Vigencia:</strong> Del {{ \Carbon\Carbon::parse($promocion['fechaDesde'])->format('d/m/Y') }} al {{ \Carbon\Carbon::parse($promocion['fechaHasta'])->format('d/m/Y') }}
                          <br>
                          <strong>Días:</strong> {{ implode(', ', $promocion['diasSemana']) }}
                          <br>
                          <strong>Cantidad de usos:</strong> {{ $promocion['usos_promocion_count'] }}
                      </li>
                  @endforeach
              @endif
          </ul>
          <hr>
      @endforeach
    </div>
  </div>
</div>

@endsection