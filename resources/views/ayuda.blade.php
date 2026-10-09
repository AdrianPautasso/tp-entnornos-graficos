@extends('layouts.app')

@section('title', 'Cómo usar el sitio')
@section('meta_description', 'Guía de uso del shopping: cómo registrarse, ver y usar promociones, y administrar según el rol.')

@section('content')
<div class="container py-4">
    <h1 class="mb-3">Cómo usar el sitio</h1>

    <p class="text-muted mb-4">
        Esta sección reúne las guías para aprovechar el shopping según su perfil:
        <a href="#cliente">Cliente</a>,
        <a href="#dueno">Dueño de Local</a> y
        <a href="#admin">Administrador</a>.
    </p>

    <div class="row g-4">

        {{-- Cliente --}}
        <div class="col-md-4" id="cliente">
            <div class="card h-100 shadow-sm">
                <div class="card-header">
                    <h2 class="h5 mb-0">Cliente / Visitante</h2>
                </div>
                <div class="card-body">
                    <ol class="mb-0">
                        <li class="mb-2"><strong>Ver promociones:</strong> en <em>Promociones</em> puede filtrar por local o buscar con el cuadro de búsqueda.</li>
                        <li class="mb-2"><strong>Registrarse:</strong> si aún no tiene cuenta, use <em>Registrarse</em> y complete el formulario.</li>
                        <li class="mb-2"><strong>Usar una promoción:</strong> inicie sesión, elija el local, ingrese el código y seleccione la promoción que aplica para su categoría.</li>
                        <li class="mb-2"><strong>Consultar usos:</strong> en <em>Mis usos</em> verá el detalle de las promociones utilizadas.</li>
                    </ol>
                </div>
            </div>
        </div>

        {{-- Dueño --}}
        <div class="col-md-4" id="dueno">
            <div class="card h-100 shadow-sm">
                <div class="card-header">
                    <h2 class="h5 mb-0">Dueño de Local</h2>
                </div>
                <div class="card-body">
                    <ol class="mb-0">
                        <li class="mb-2"><strong>Ofrecer promociones:</strong> en <em>Gestión de Promociones</em> cree sus promociones indicando categoría mínima, días y vigencia.</li>
                        <li class="mb-2"><strong>Controlar el uso:</strong> al registrar el uso de una promoción por un cliente se actualiza automáticamente el historial y el reporte del administrador.</li>
                        <li class="mb-2"><strong>Estados:</strong> la promoción puede quedar <em>Pendiente</em> hasta que un administrador la apruebe.</li>
                    </ol>
                </div>
            </div>
        </div>

        {{-- Admin --}}
        <div class="col-md-4" id="admin">
            <div class="card h-100 shadow-sm">
                <div class="card-header">
                    <h2 class="h5 mb-0">Administrador</h2>
                </div>
                <div class="card-body">
                    <ol class="mb-0">
                        <li class="mb-2"><strong>Gestionar la base:</strong> usuarios, locales y categorías se administran desde el menú.</li>
                        <li class="mb-2"><strong>Aprobar promociones:</strong> apruebe o rechace las promociones cargadas por dueños.</li>
                        <li class="mb-2"><strong>Publicar novedades:</strong> las novedades aprobadas se muestran en la portada.</li>
                        <li class="mb-2"><strong>Reporte de uso:</strong> descargue el detalle de usos de promociones por local y por promoción.</li>
                    </ol>
                </div>
            </div>
        </div>

    </div>

    <p class="mt-4 text-muted small">
        ¿Tiene dudas puntuales? Consulte las <a href="{{ route('faq') }}">Preguntas Frecuentes</a> o
        escribanos desde <a href="{{ route('contacto') }}">Contacto</a>.
    </p>
</div>
@endsection
