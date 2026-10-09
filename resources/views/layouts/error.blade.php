<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Error') · Shopping Rosario</title>
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



    </div>

  </div>
</nav>

    <main class="container v-100">
      <div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow text-center">

                <div class="card-body p-5">

                    <h1 class="display-1 fw-bold text-primary">
                        404
                    </h1>

                    <h2 class="mb-3">
                        Página no encontrada
                    </h2>

                    <p class="text-muted">
                        La página que estás buscando no existe,
                        fue eliminada o la dirección ingresada es incorrecta.
                    </p>

                    <div class="mt-4">

                        <a href="{{ route('home') }}" 
                           class="btn btn-primary">
                            Volver al inicio
                        </a>



                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

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
                    Email: info@shoppingrosario.com
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


    <!-- JS de Bootstrap (opcional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>


</html>