<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Iniciar Sesión</title>
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f1f9ff;
    margin: 0;
    padding: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
  }

  .login-card {
    background-color: #ffffff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    max-width: 400px;
    width: 100%;
  }

  h2 {
    color: #003366;
    text-align: center;
  }

  p {
    text-align: center;
    color: #777;
  }

  label {
    display: block;
    margin-top: 15px;
    font-weight: bold;
  }

  input[type="email"],
  input[type="password"],
  select {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border-radius: 4px;
    border: 1px solid #ccc;
    box-sizing: border-box;
  }

  .rol-select {
    margin-top: 10px;
  }

  button {
    width: 100%;
    padding: 15px;
    margin-top: 20px;
    background-color: #28a745;
    color: white;
    border: none;
    border-radius: 6px;
    font-size: 16px;
    cursor: pointer;
  }

  button:hover {
    background-color: #218838;
  }

  .footer {
    text-align: center;
    margin-top: 15px;
    font-size: 14px;
  }

  .footer a {
    color: #ff6600;
    text-decoration: none;
  }
</style>
</head>
<body>

<div class="login-card">
  <h2>Iniciar Sesión</h2>
  <p>Ingresa tus datos para acceder a tu cuenta</p>
  <form id="loginForm" action="#" method="POST" onsubmit="return false;">
    <label for="email">Correo electrónico</label>
    <input type="email" id="email" placeholder="tu@email.com" required />

    <label for="password">Contraseña</label>
    <input type="password" id="password" placeholder="Tu contraseña" required />

    <label for="rol" class="rol-select">Rol</label>
    <select id="rol" required>
      <option value="">Selecciona tu rol</option>
      <option value="admin">Administrador</option>
      <option value="user">Usuario</option>
    </select>

    <button onclick="alert('Inicio de sesión')">Iniciar Sesión</button>
  </form>
  <div class="footer">
    ¿No tienes cuenta? <a href="#">Regístrate aquí</a>
  </div>
</div>

</body>
</html>