@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        {{-- Sidebar Izquierda --}}
        <x-admin-sidebar/>
        

        {{-- Contenido Principal --}}
        <div class="col-md-9">
            <h1>Bienvenido, {{ auth()->user()->nombre }}</h1>
                <h2>Administrador</h2>
                <h3>Funciones</h3>
                <ul>
                  <li style="text-decoration:line-through;">Validar cuentas de dueños de locales.</li>
                  <li style="text-decoration:line-through;">Crear, editar y eliminar locales. </li>
                  <li style="text-decoration:line-through;">Aprobar o denegar una solicitud de promoción de un local.</li>
                  <li>Ver reportes acerca de la utilización de las promociones. </li>
                  <li style="text-decoration:line-through;">Crear, editar y eliminar novedades del shopping.</li>
                </ul>
        </div>

    </div>
</div>

@endsection