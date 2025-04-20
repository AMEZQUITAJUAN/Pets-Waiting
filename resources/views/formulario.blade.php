
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="registration-container">
        <h1>Registro de Usuario</h1>
        <p class="subtitle">Crea tu cuenta para empezar a disfrutar de nuestros servicios</p>

        <form>
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" id="name" placeholder="Tu nombre completo" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="tu@email.com" required>
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" placeholder="••••••••" required>
            </div>

            <div class="form-group">
                <label for="confirm-password">Confirmar Contraseña</label>
                <input type="password" id="confirm-password" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn-register">Registrarse</button>
        </form>

        <div class="login-link">
            ¿Ya tienes una cuenta? <a href="#">Inicia sesión</a>
        </div>
    </div>
</body>
</html>
