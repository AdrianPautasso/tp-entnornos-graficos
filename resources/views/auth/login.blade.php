@extends('layouts.app')


@section('content')
<body>
    <h1>Iniciar Sesión</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div>
            <label for="usuario">Usuario o Email:</label>
            <input type="text" name="usuario" id="usuario" value="{{ old('usuario') }}" required autofocus>
        </div>
        <div>
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" required>
        </div>
        <button type="submit">Ingresar</button>
    </form>

    <p>¿No tenés cuenta? <a href="{{ route('register') }}">Registrate</a></p>
</body>

@endsection

