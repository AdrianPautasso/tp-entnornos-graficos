@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Cliente</h2>
    <h3>Funciones</h3>
    <ul>
        <li style="text-decoration:line-through;">Registrarse en el sistema para acceder a las ofertas del shopping.</li>
        <li style="text-decoration:line-through;">Buscar promociones en los locales del shopping.</li>
        <li style="text-decoration:line-through;">Ingresar el código de un local y elegir una promocion disponible.</li>
        <li style="text-decoration:line-through;">Ver las novedades del shopping.</li>
    </ul>
    <h2>Promociones Utilizadas</h2>
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
                            <form action="{{ route('usoPromociones.eliminar', $up->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <!-- <input type="hidden" name="idUsoPromocion" value="{{ $up->id }}"> -->
                                <button type="submit" class="btn btn-primary w-100">Cancelar Uso Promoción</button>
                            </form>
                        @endif
                    </div>
                </div>
            @empty
                <p>No hay promociones utilizadas.</p>
            @endforelse
        @endif
    </div>
    <h2>Promociones Vigentes</h2>
    <input type="text" id="buscar" class="form-control mb-3" placeholder="Buscar por nombre del negocio...">
    <div class="row" id="promociones"> 
        @if(isset($promociones_disponibles))
            @forelse($promociones_disponibles as $p)
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $p->local->nombre }}</h5>
                            <p class="card-text">{{ $p->texto }}</p>
                            <p><strong>Válida hasta: </strong> {{ $p->fechaHasta }}</p>
                            <p><strong>Válida los días: </strong>{{ implode(", ",$p->diasSemana) }}</p>
                        </div>
                        

                        <form action="{{ route('usopromociones.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="idPromocion" value="{{ $p->id }}">
                            <button type="submit" class="btn btn-primary w-100">Usar Promoción</button>
                        </form>
                        
                    </div>
                </div>
            @empty
                <p>No hay promociones vigentes.</p>
            @endforelse
        @endif
    </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
      const buscarInput = document.getElementById('buscar');
      const promocionesContainer = document.getElementById('promociones');

      if (buscarInput) {
          buscarInput.addEventListener('keyup', function () {
              const valor = this.value.trim();
              if (valor === '') {
                fetch('{{ route("promociones") }}')
                    .then(response => response.text())
                    .then(html => {
                        const tempElement = document.createElement('div');
                        tempElement.innerHTML = html;
                        const todasLasPromociones = tempElement.querySelector('#promociones').innerHTML;
                        promocionesContainer.innerHTML = todasLasPromociones;
                    })
                    .catch(error => console.error('Error:', error));
                return; // Sale de la función
              }

              // Si el valor no está vacío, se realiza la búsqueda normal
              fetch('{{ route("promociones") }}?search=' + encodeURIComponent(valor))
                  .then(response => response.text())
                  .then(html => {
                      const tempElement = document.createElement('div');
                      tempElement.innerHTML = html;
                      const nuevasPromociones = tempElement.querySelector('#promociones').innerHTML;
                      promocionesContainer.innerHTML = nuevasPromociones;
                  })
                  .catch(error => console.error('Error:', error));
                              
              

          });
      }
  });
</script>
@endsection