@extends('layouts.app')

@section('title', 'Contacto')

@section('content')

<div class="d-flex justify-content-center align-items-center v-100" style="height: 100%;">

    <div class="col-6">
        <div class="row">
            <div class="col-12">
                <h1>Contacto</h1>
                <p class="text-muted">
                    Completá el formulario y nos pondremos en contacto con vos a la brevedad.
                </p>
            </div>
        </div>

        @if (session('success'))
        <div class="row">
            <div class="col-12">
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            </div>
        </div>
        @endif

        @if ($errors->any())
        <div class="row">
            <div class="col-12">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif

        <form method="POST" action="{{ route('contacto.enviar') }}">
            @csrf
            <div class="row mb-3">
                <div class="col-12">
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <label for="mensaje">Mensaje:</label>
                    <textarea name="mensaje" id="mensaje" class="form-control" rows="5" required>{{ old('mensaje') }}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection