@extends('layouts.app')

@section('title', 'Preguntas Frecuentes')

@section('content')

<div class="container py-4">

    <h1 class="mb-3">Preguntas Frecuentes</h1>

    <p class="text-muted mb-4">
        En esta sección encontrará respuestas a las consultas más habituales sobre el funcionamiento del sistema de promociones del shopping.
    </p>

    <div class="accordion" id="faqAccordion">

        <div class="accordion-item">
            <h2 class="accordion-header" id="faq1">
                <button class="accordion-button" type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#collapse1">
                    ¿Cómo me registro como cliente?
                </button>
            </h2>
            <div id="collapse1" class="accordion-collapse collapse show"
                 data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Seleccione la opción <strong>Registrarse</strong>, complete el formulario y confirme su cuenta desde el enlace enviado a su correo electrónico.
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="faq2">
                <button class="accordion-button collapsed" type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#collapse2">
                    ¿Cómo obtengo una promoción?
                </button>
            </h2>
            <div id="collapse2" class="accordion-collapse collapse"
                 data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Inicie sesión, seleccione un local, ingrese su código y elija una promoción disponible para su categoría.
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="faq3">
                <button class="accordion-button collapsed" type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#collapse3">
                    ¿Por qué no veo todas las promociones?
                </button>
            </h2>
            <div id="collapse3" class="accordion-collapse collapse"
                 data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Las promociones visibles dependen de su categoría de cliente (Inicial, Medium o Premium), de la fecha de vigencia y del día de la semana.
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="faq4">
                <button class="accordion-button collapsed" type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#collapse4">
                    ¿Cómo cambio de categoría?
                </button>
            </h2>
            <div id="collapse4" class="accordion-collapse collapse"
                 data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    El sistema actualiza automáticamente la categoría según la cantidad de promociones utilizadas durante los últimos seis meses.
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="faq5">
                <button class="accordion-button collapsed" type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#collapse5">
                    Soy dueño de un local. ¿Cómo publico una promoción?
                </button>
            </h2>
            <div id="collapse5" class="accordion-collapse collapse"
                 data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Ingrese al sistema con su cuenta, cree la promoción y espere la aprobación del administrador del shopping antes de que quede disponible para los clientes.
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="faq6">
                <button class="accordion-button collapsed" type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#collapse6">
                    ¿Cómo puedo comunicarme con el administrador?
                </button>
            </h2>
            <div id="collapse6" class="accordion-collapse collapse"
                 data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Puede utilizar la página de contacto o enviar un correo electrónico a
                    <strong>info@shoppingrosario.com</strong>.
                </div>
            </div>
        </div>

    </div>

</div>

@endsection
