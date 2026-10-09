@extends('layouts.app')

@section('title', 'Sobre el Shopping')

@section('content')

<div class="container py-4">

    <h1 class="mb-4">Sobre el Shopping</h1>

    <div class="row">
        <div class="col-12 mb-4">
            <h2>Quiénes somos</h2>
            <p class="text-muted">
                Shopping Rosario es el centro comercial de la ciudad. Reunimos a los mejores
                locales de Rosario en un mismo espacio, acercando a nuestros visitantes
                promociones, novedades y una experiencia de compra completa durante todo el año.
            </p>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-12 col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title">Misión</h3>
                    <p class="card-text">
                        Ofrecer a la comunidad rosarina un espacio único de compra y esparcimiento,
                        con propuestas comerciales variadas, promociones accesibles y un servicio
                        de calidad para todas las personas.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title">Visión</h3>
                    <p class="card-text">
                        Ser el centro comercial de referencia de la región, reconocido por su
                        innovación, la excelencia de sus locales y la confianza de los clientes
                        que lo eligen cada día.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title">Objetivos</h3>
                    <ul class="mb-0">
                        <li>Brindar las mejores promociones a nuestros clientes.</li>
                        <li>Apoyar a los locales que forman parte del shopping.</li>
                        <li>Mantener informada a la comunidad con novedades y eventos.</li>
                        <li>Garantizar una experiencia de compra segura y accesible.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-12 col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title">Contacto e información</h3>
                    <p class="mb-1">Dirección: Bv. Rondeau 1234, Rosario, Santa Fe</p>
                    <p class="mb-1">Teléfono: (0341) 456-7890</p>
                    <p class="mb-1">Email: info@shoppingrosario.com</p>
                    <p class="mb-0">Horarios: Lunes a domingo de 10:00 a 21:00 hs.</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title">Necesitás ayuda?</h3>
                    <p class="card-text">
                        Consultá nuestras preguntas frecuentes o escribinos a través del
                        formulario de contacto.
                    </p>
                    <a href="{{ route('faq') }}" class="btn btn-primary">Preguntas frecuentes</a>
                    <a href="{{ route('contacto') }}" class="btn btn-outline-primary">Contacto</a>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection