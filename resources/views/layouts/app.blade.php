<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Entornos gráficos 2025</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 (opcional pero recomendado) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
   
</head>
<body class="d-flex flex-column min-vh-100">

  <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}">Entornos 2025</a>

      {{-- Botón toggle para versión móvil --}}
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">

        @auth
        <ul class="navbar-nav ms-auto">
          <li class="nav-item dropdown">
            <a 
              class="nav-link dropdown-toggle d-flex align-items-center" 
              href="#" 
              id="userDropdown" 
              role="button" 
              data-bs-toggle="dropdown" 
              aria-expanded="false"
            >
              <img src="{{ asset('images/person-circle.svg') }}" alt="Usuario" width="30" height="30" class="rounded-circle me-2">
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
          @if (!Request::is('login') && !Request::is('register'))
          <ul class="navbar-nav ms-auto">
              <li class="nav-item me-2">
                  <a href="{{ route('login') }}" class="btn btn-outline-primary">
                      <i class="bi bi-box-arrow-in-right me-1"></i> Iniciar sesión
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('register') }}" class="btn btn-primary">
                      <i class="bi bi-person-plus me-1"></i> Registrarse
                  </a>
              </li>
          </ul>
          @endif
        @endauth

      </div>
    </div>
  </nav>

    <main class="container v-100">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="navbar navbar-expand-lg navbar-light bg-light mt-auto">
        <div class="container">
            <span class="navbar-text mx-auto">
                &copy; {{ date('Y') }} Mi App. Todos los derechos reservados.
            </span>
        </div>
    </footer>


    <!-- JS de Bootstrap (opcional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>


</html>