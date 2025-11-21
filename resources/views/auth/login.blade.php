@extends('layouts.app')


@section('content')

<div class="d-flex justify-content-center align-items-center v-100" style="height: 100%;">

    <div class="col-4">
        <div class="row">
            <div class="col-12">
                <h1>Iniciar Sesión</h1>
            </div>
        </div>

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

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="row mb-3">
                <div class="col-12">
                    <label for="usuario">Usuario o Email:</label>
                    <input type="text" name="usuario" id="usuario" class="form-control" value="{{ old('usuario') }}" required autofocus>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <label for="password">Contraseña:</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Ingresar</button>
                </div>
            </div>
        </form>

        <div class="row mt-3">
            <div class="col-12">
                <p>¿No tenés cuenta? <a href="{{ route('register') }}">Registrate</a></p>
            </div>
        </div>
    </div>
</div>

@endsection