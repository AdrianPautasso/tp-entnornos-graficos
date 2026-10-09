@extends('layouts.app')

@section('title', 'Organigrama y autoridades')

@section('meta_description', 'Organigrama del Shopping Rosario: autoridades por sector con teléfono y correo de contacto directo.')

@section('content')
<div class="container py-4">
    <h1>Organigrama y autoridades</h1>
    <p class="lead mb-4">
        Conocé la estructura del Shopping Rosario y a las personas encargadas de cada área.
        Cada autoridad tiene un canal de contacto directo para consultas y sugerencias.
    </p>

    <div class="row g-4 justify-content-center text-center mb-4">
        <div class="col-12 col-md-5 col-lg-4">
            <div class="card h-100 border-primary">
                <div class="card-body">
                    <h2 class="card-title h5">Dirección General</h2>
                    <p class="mb-1 fw-semibold">Ing. Roberto Márquez</p>
                    <p class="text-muted small mb-3">Director General del Shopping</p>
                    <p class="mb-0 small">Tel: (0341) 456-7890 int. 10</p>
                    <p class="mb-0 small">direccion@shoppingrosario.com</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <!-- Administración -->
        <div class="col-12 col-md-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <h2 class="card-title h5">Administración</h2>
                    <p class="mb-1 fw-semibold">CPN Martín Ferreyra</p>
                    <p class="text-muted small mb-3">Gerente de Administración</p>
                    <p class="mb-0 small">Tel: (0341) 456-7890 int. 21</p>
                    <p class="mb-0 small">admin@shoppingrosario.com</p>
                </div>
            </div>
        </div>
        <!-- Comercial -->
        <div class="col-12 col-md-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <h2 class="card-title h5">Comercial</h2>
                    <p class="mb-1 fw-semibold">Lic. Sofía Benítez</p>
                    <p class="text-muted small mb-3">Gerente Comercial</p>
                    <p class="mb-0 small">Tel: (0341) 456-7890 int. 32</p>
                    <p class="mb-0 small">comercial@shoppingrosario.com</p>
                </div>
            </div>
        </div>
        <!-- Operaciones -->
        <div class="col-12 col-md-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <h2 class="card-title h5">Operaciones y Mantenimiento</h2>
                    <p class="mb-1 fw-semibold">Ing. Diego Roldán</p>
                    <p class="text-muted small mb-3">Jefe de Operaciones</p>
                    <p class="mb-0 small">Tel: (0341) 456-7890 int. 43</p>
                    <p class="mb-0 small">operaciones@shoppingrosario.com</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <h2 class="h5 mb-2">Comunicación con las autoridades</h2>
            <p class="mb-1">Para quejas o sugerencias puede escribir a <a href="mailto:quejas@shoppingrosario.com">quejas@shoppingrosario.com</a> o llamar al (0341) 456-7890.</p>
            <p class="mb-0 small text-muted">Todas las consultas se responden dentro de las 48 h hábiles.</p>
        </div>
    </div>
</div>
@endsection
