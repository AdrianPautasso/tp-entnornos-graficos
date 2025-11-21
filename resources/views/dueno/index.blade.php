@extends('layouts.app')

@section('content')


<div class="container-fluid">
    <div class="row">
        {{-- Sidebar Izquierda --}}
        <x-dueno-sidebar/>

        {{-- Contenido Principal --}}
        <div class="col-md-9">
            <h1>Bienvenido, {{ auth()->user()->nombre }}</h1>
            <h2>Dueño de local</h2>
            <h3>Funciones</h3>
            <ul>
              <li style="text-decoration:line-through;">Crear y eliminar promociones en su propio local. 
                No se permite la edición para evitar consideraciones de publicidad engañosa. 
                En caso de cometer errores en la carga, deberá eliminar la promoción.</li>
              <li style="text-decoration:line-through;">Aceptar o rechazar una solicitud de promoción de un cliente.</li>
              <li style="text-decoration:line-through;">Ver la cantidad de clientes que usaron una promoción. </li>
            </ul>
        </div>

    </div>
</div>




@endsection