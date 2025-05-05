@extends('layouts.app')

@section('content')
<div class="registration-container">
    <h1>Registro de Usuario</h1>
    <p class="subtitle">Crea tu cuenta para empezar a disfrutar de nuestros servicios</p>

    @if ($errors->any())
        <div class="error-messages">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('usuarios.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text"
                   id="nombre"
                   name="nombre"
                   value="{{ old('nombre') }}"
                   placeholder="Tu nombre completo"
                   required>
            @error('nombre')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Correo electrónico</label>
            <input type="email"
                   id="email"
                   name="email"
                   value="{{ old('email') }}"
                   placeholder="tu@email.com"
                   required>
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password"
                   id="password"
                   name="password"
                   placeholder="••••••••"
                   required>
            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn-register">Registrarse</button>
    </form>

    <div class="login-link">
        ¿Ya tienes una cuenta? <a href="{{ route('login') }}">Iniciar Sesión</a>
    </div>
</div>
@endsection
