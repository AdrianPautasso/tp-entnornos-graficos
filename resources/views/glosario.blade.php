@extends('layouts.app')

@section('title', 'Glosario')

@section('content')
<div class="container py-4">
    <h1>Glosario</h1>
    <p class="lead mb-4">
        Definiciones de los términos técnicos que usan el Shopping Rosario, las promociones
        y los distintos perfiles del sitio. Si después de leerlo te queda una duda, escribinos
        desde la <a href="{{ route('contacto') }}">página de contacto</a>.
    </p>

    <h2 id="a">A</h2>
    <div class="row g-4 mb-4">
        <div class="col-12 col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title h6">Alta de local</h3>
                    <p class="mb-0">Registro de un comercio en el shopping. Lo realiza el administrador del sitio; el local pasa a estar disponible para recibir promociones.</p>
                </div>
            </div>
        </div>
    </div>

    <h2 id="c">C</h2>
    <div class="row g-4 mb-4">
        <div class="col-12 col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title h6">Cliente</h3>
                    <p class="mb-0">Perfil de usuario registrado que recorre las promociones vigentes y puede usar los códigos para ahorrar en los locales.</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title h6">Código de promoción</h3>
                    <p class="mb-0">Texto alfanumérico corto que identifica una promoción y se ingresa al canjearla en el local. Es único por promoción.</p>
                </div>
            </div>
        </div>
    </div>

    <h2 id="d">D</h2>
    <div class="row g-4 mb-4">
        <div class="col-12 col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title h6">Dueño</h3>
                    <p class="mb-0">Perfil asociado a un local. Crea promociones para su comercio y registra los usos de los códigos canjeados por sus clientes.</p>
                </div>
            </div>
        </div>
    </div>

    <h2 id="e">E</h2>
    <div class="row g-4 mb-4">
        <div class="col-12 col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title h6">Estado de una promoción</h3>
                    <p class="mb-0">Situación en el ciclo de vida de una promoción: <strong>pendiente</strong> (espera revisión), <strong>aprobada</strong> (visible para clientes) o <strong>rechazada</strong> (no se publica).</p>
                </div>
            </div>
        </div>
    </div>

    <h2 id="l">L</h2>
    <div class="row g-4 mb-4">
        <div class="col-12 col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title h6">Local</h3>
                    <p class="mb-0">Comercio inscrito en el shopping, con sus datos de contacto y sus promociones asociadas.</p>
                </div>
            </div>
        </div>
    </div>

    <h2 id="n">N</h2>
    <div class="row g-4 mb-4">
        <div class="col-12 col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title h6">Novedad</h3>
                    <p class="mb-0">Aviso institucional o evento publicado por el administrador. Aparece en la portada del sitio para llegar a todos los visitantes.</p>
                </div>
            </div>
        </div>
    </div>

    <h2 id="p">P</h2>
    <div class="row g-4 mb-4">
        <div class="col-12 col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title h6">Perfil</h3>
                    <p class="mb-0">Conjunto de permisos según el tipo de usuario: <strong>cliente</strong>, <strong>dueño</strong> o <strong>administrador</strong>. El perfil define qué secciones del menú se muestran.</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title h6">Promoción</h3>
                    <p class="mb-0">Oferta con descuento y vigencia, creada por el dueño de un local. Se aprueba antes de publicarse y los clientes la canjean con su código.</p>
                </div>
            </div>
        </div>
    </div>

    <h2 id="r">R</h2>
    <div class="row g-4 mb-4">
        <div class="col-12 col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title h6">Reporte de uso</h3>
                    <p class="mb-0">Resumen administrativo con la cantidad de códigos canjeados por promoción y local, usado para medir el impacto de las ofertas.</p>
                </div>
            </div>
        </div>
    </div>

    <h2 id="u">U</h2>
    <div class="row g-4 mb-4">
        <div class="col-12 col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title h6">Uso de promoción</h3>
                    <p class="mb-0">Registro de un canje: un cliente aplicó el código de una promoción en un local. Queda asociado al cliente, al local y a la fecha del canje.</p>
                </div>
            </div>
        </div>
    </div>

    <h2 id="v">V</h2>
    <div class="row g-4 mb-4">
        <div class="col-12 col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title h6">Vigencia</h3>
                    <p class="mb-0">Período durante el cual una promoción puede usarse. Fuera de esas fechas la promoción deja de admitir canjes.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
