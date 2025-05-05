@extends('layouts.app')

@section('content')
<div class="login-card">
    <h2>Iniciar Sesión</h2>
    <p>Ingresa tus datos para acceder a tu cuenta</p>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <label for="email">Correo electrónico</label>
        <input type="email"
               id="email"
               name="email"
               value="{{ old('email') }}"
               placeholder="tu@email.com"
               required />

        <label for="password">Contraseña</label>
        <input type="password"
               id="password"
               name="password"
               placeholder="Tu contraseña"
               required />

        <label for="rol" class="rol-select">Rol</label>
        <select id="rol" name="rol" required>
            <option value="">Selecciona tu rol</option>
            <option value="admin" {{ old('rol') == 'admin' ? 'selected' : '' }}>Administrador</option>
            <option value="user" {{ old('rol') == 'user' ? 'selected' : '' }}>Usuario</option>
        </select>

        <button type="submit">Iniciar Sesión</button>
    </form>

    <div class="footer">
        ¿No tienes cuenta? <a href="{{ route('usuarios.create') }}">Regístrate aquí</a>
    </div>
</div>
@endsection
