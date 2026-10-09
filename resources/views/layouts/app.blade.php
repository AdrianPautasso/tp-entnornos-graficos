<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Inicio') · Shopping Rosario</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 (opcional pero recomendado) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
   
</head>
<body class="d-flex flex-column min-vh-100">
   
  <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4 py-3">
  <div class="container position-relative">

    <!-- Marca izquierda -->
    <a class="navbar-brand" href="{{ url('/') }}">
      Shopping Rosario
    </a>

    <!-- Botón toggle mobile -->
    <button class="navbar-toggler" type="button"
      data-bs-toggle="collapse"
      data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>


    <a href="{{ route('home') }}"
       class="position-absolute top-50 start-50 translate-middle">
      <img src="{{ asset('images/logo.png') }}" height="75" alt="Logo">
    </a>

    <!-- Menú derecha -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">

  

      @auth
      <ul class="navbar-nav ms-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle d-flex align-items-center"
             href="#"
             id="userDropdown"
             role="button"
             data-bs-toggle="dropdown"
             aria-expanded="false">
            <img src="{{ asset('images/person-circle.svg') }}"
                 alt="Usuario"
                 width="30"
                 height="30"
                 class="rounded-circle me-2">
            {{ Auth::user()->nombre }}
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
            <li>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="dropdown-item">Salir</button>
              </form>
            </li>
          </ul>
        </li>
      </ul>
      @else

      @if (!Request::is('404'))
          <ul class="navbar-nav ms-auto">
          <li class="nav-item me-2">

          </li>
          <li class="nav-item">

          </li>
        </ul>
      @endif


        @if (!Request::is('login') && !Request::is('register'))
        <ul class="navbar-nav ms-auto">
          <li class="nav-item me-2">
            <a href="{{ route('login') }}" class="btn btn-outline-primary">
              Iniciar sesión
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('register') }}" class="btn btn-primary">
              Registrarse
            </a>
          </li>
        </ul>
        @endif
      @endauth

    </div>

  </div>
</nav>

    <main class="container v-100">
      @include('partials.breadcrumb')  
      @yield('content')
    </main>

{{-- Footer --}}
<footer class="bg-light mt-auto py-4 border-top">
    <div class="container">
        <div class="row text-center text-md-start">

            <!-- Dirección -->
            <div class="col-12 col-md-4 mb-3 mb-md-0">
                <h6 class="fw-bold">Dirección</h6>
                <p class="mb-0">
                    Bv. Rondeau 1234<br>
                    Rosario, Santa Fe
                </p>
            </div>

            <!-- Contacto -->
            <div class="col-12 col-md-4 mb-3 mb-md-0">
                <h6 class="fw-bold">Contacto</h6>
                <p class="mb-0">
                    Tel: (0341) 456-7890<br>
                    Email: info@shoppingrosario.com<br>
                    <a href="{{ route('promociones') }}">Promociones</a><br>
                <a href="{{ route('ayuda') }}">Cómo usar el sitio</a><br>
                    <a href="{{ route('organigrama') }}">Organigrama y autoridades</a><br>
                    <a href="{{ route('glosario') }}">Glosario</a><br>
                    <a href="{{ route('faq') }}">Preguntas Frecuentes</a><br>
                    <a href="{{ route('contacto') }}">Contacto</a>
                </p>
            </div>

            <!-- Copyright -->
            <div class="col-12 col-md-4 text-md-end">
                <h6 class="fw-bold">Información legal</h6>
                <p class="mb-0">
                    &copy; {{ date('Y') }} Shopping Rosario<br>
                    Todos los derechos reservados.
                </p>
            </div>

        </div>
    </div>

</footer>


    <!-- JS de Bootstrap (CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Check 20: validación de formularios en el cliente (archivo propio, sin build).
         Bloquea envíos con required vacío y marca los campos. -->
    <script src="{{ asset('js/app.validation.js') }}" defer></script>


</body>


</html>