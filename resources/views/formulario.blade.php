<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
</head>
<body>
{{-- filepath: c:\xampp\htdocs\Pets-Waiting\resources\views\formulario.blade.php --}}
@if ($errors->any())
    <div class="error-messages">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="registration-container">
        <h1>Registro de Usuario</h1>
        <p class="subtitle">Crea tu cuenta para empezar a disfrutar de nuestros servicios</p>

        {{-- Abrimos el formulario y le decimos que vaya a la ruta usuarios.store --}}
        <form action="{{ route('usuarios.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" placeholder="Tu nombre completo" required>
            </div>

            @error('nombre')
                <div class="error">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input type="email" id="email" name="email" placeholder="tu@email.com" required>
            </div>

            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" placeholder="••••••••" required>
            </div>

            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror

            <button type="submit" class="btn-register">Registrarse</button>
            <a href="formulario.blade.php"></a>
        </form>

        <div class="login-link">
            ¿Ya tienes una cuenta? <a href="{{ route('usuarios.index') }}">Ver lista de usuarios</a>
        </div>
    </div>
    <section class="suscripcion">
    <h2>Únete a nuestra causa</h2>
    <form>
        <button type="submit">Iniciar Sesion</button>
    </form>
    <a href="{{ route('usuarios.create') }}" class="btn-register">Registrarse</a>
    <p>Al suscribirte, aceptas recibir actualizaciones sobre nuestras mascotas y eventos. <a href="#">Términos y condiciones</a>.</p>
</section>
</body>
</html>
