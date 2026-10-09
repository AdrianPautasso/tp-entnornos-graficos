@extends('layouts.app')

@section('title', 'Panel de Dueño')

@section('content')


<div class="container-fluid">
    <div class="row">
        {{-- Sidebar Izquierda --}}
        <x-dueno-sidebar/>

        {{-- Contenido Principal --}}
        <div class="col-md-9">
            <h1>Bienvenido, {{ auth()->user()->nombre }}</h1>
            <h2>Dueño de local</h2>
        </div>

    </div>
</div>




@endsection