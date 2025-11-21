@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        {{-- Sidebar Izquierda --}}
        <x-dueno-sidebar/>
        

        {{-- Contenido Principal --}}

        <div class="col-md-9">
          <h2>Gestión Uso Promociones</h2>
          <div class="row" id="usos_promociones"> 
              @if(isset($usos_promociones))
                  @forelse($usos_promociones as $up)
                      <div class="col-md-4 mb-3">
                          <div class="card h-100">
                              <div class="card-body">
                                  <h5 class="card-title">{{ $up->promocion->local->nombre }}</h5>
                                  <p class="card-text">{{ $up->promocion->texto }}</p>
                                  <p><strong>Válida hasta: </strong> {{ $up->promocion->fechaHasta }}</p>
                                  <p><strong>Válida los días: </strong>{{ implode(", ",$up->promocion->diasSemana) }}</p>
                                  <p>{{$up->fechaUso }}</p>
                                  <p>{{$up->estado }}</p>
                              </div>
                                @if($up->estado == 'Enviada')
                                    <div class="card-footer">
                                    <div class="d-flex justify-content-between">
                                        <!-- Botón Aceptar -->
                                        <form action="{{ route('usoPromociones.aceptar', $up) }}" method="POST" style="flex: 1; margin-right: 5px;">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="estado" value="Aceptada">
                                        <button type="submit" class="btn btn-success w-100">
                                            ✓
                                        </button>
                                        </form>

                                        <!-- Botón Rechazar -->
                                        <form action="{{ route('usoPromociones.rechazar', $up) }}" method="POST" style="flex: 1; margin-left: 5px;">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="estado" value="Rechazada">
                                        <button type="submit" class="btn btn-danger w-100">
                                            x
                                        </button>
                                        </form>
                                    </div>
                                    </div>
                                @endif
                          </div>
                      </div>
                  @empty
                      <p>No hay promociones utilizadas.</p>
                  @endforelse
              @endif
          </div>
        </div>


    </div>
</div>

@if(session('success'))
    <div class="toast-container position-fixed bottom-0 start-50 translate-middle-x p-3" style="z-index: 1055;">
        <div id="successToast" class="toast align-items-center text-bg-success border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Cerrar"></button>
            </div>
        </div>
    </div>
@endif

@endsection