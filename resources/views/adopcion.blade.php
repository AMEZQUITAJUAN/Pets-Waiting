@extends('layouts.app')
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Gestión de Adopción</title>
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #e0f7e9;
    margin: 0;
    padding: 20px;
  }

  .container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
  }

  /* formulario */
  .form-section {
    background: #d0e8f2;
    padding: 20px;
    border-radius: 8px;
    flex: 1 1 300px;
    max-width: 600px;
  }

  h2 {
    color: #007bff;
  }

  label {
    display: block;
    margin-top: 10px;
  }

  input[type="text"],
  textarea,
  select {
    width: 100%;
    padding: 8px;
    margin-top: 5px;
    border-radius: 4px;
    border: 1px solid #ccc;
    box-sizing: border-box;
  }

  textarea {
    resize: vertical;
  }

  .btn {
    display: inline-block;
    padding: 10px 15px;
    margin-top: 15px;
    background-color: orange;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  .btn:hover {
    background-color: #e65c00;
  }

  /* mascotas disponibles */
  .pets-section {
    background-color: #f0f4f8;
    padding: 20px;
    border-radius: 8px;
    flex: 1 1 300px;
    max-width: 600px;
  }

  h3 {
    margin-top: 0;
  }

  .pet-card {
    background: white;
    padding: 10px;
    margin-top: 10px;
    border-radius: 6px;
    box-shadow: 0 1px 4px rgba(0,0,0,0.1);
  }

  .adopt-btn {
    background-color: #28a745;
    color: white;
    padding: 8px 12px;
    border-radius: 4px;
    border: none;
    cursor: pointer;
  }

  .adopt-btn:hover {
    background-color: #218838;
  }

  /* pie de contacto */
  footer {
    background-color: #ffd8b1;
    margin-top: 30px;
    padding: 20px;
    border-radius: 8px;
    max-width: 1000px;
    margin-left: auto;
    margin-right: auto;
  }

  .contacto {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
  }

  .contacto p {
    margin: 8px 0;
  }

  /* inputs de contacto */
  .contact-input {
    width: 100%;
    padding: 8px;
    margin-top: 5px;
    border-radius: 4px;
    border: 1px solid #ccc;
    box-sizing: border-box;
  }
</style>
</head>
<body>

<div class="container">
  <!-- Formulario solicitud -->
  <div class="form-section">
    <h2>Solicitud de Adopción</h2>
    <form id="adopcionForm" action="#" method="POST" onsubmit="return false;">
      <label for="nombre">Nombre completo</label>
      <input type="text" id="nombre" placeholder="Tu nombre" required />

      <label for="email">Correo electrónico</label>
      <input type="text" id="email" placeholder="tu@email.com" required />

      <label for="telefono">Teléfono</label>
      <input type="text" id="telefono" placeholder="Número de teléfono" required />

      <label for="tipoMascota">Tipo de mascota que deseas adoptar</label>
      <select id="tipoMascota" required>
        <option value="">Seleccionar</option>
        <option>Perro</option>
        <option>Gato</option>
        <option>Otras</option>
      </select>

      <label for="razas">Raza</label>
      <input type="text" id="razas" placeholder="Ejemplo: Labrador" />

      <label for="porque">¿Por qué quieres adoptar?</label>
      <textarea id="porque" rows="4" placeholder="Cuéntanos un poco sobre ti"></textarea>

      <button class="btn" onclick="alert('Solicitud enviada')">Enviar solicitud</button>
    </form>
  </div>

  <!-- Lista mascotas disponibles -->
  <div class="pets-section">
    <h2>Mascotas Disponibles para Adopción</h2>

    <div class="pet-card">
      <h3>Luna</h3>
      <p>Tipo: Perro</p>
      <p>Raza: Labrador</p>
      <p>Edad: 2 años</p>
      <button class="adopt-btn">Adoptar a Luna</button>
    </div>
    <div class="pet-card">
      <h3>Milo</h3>
      <img src="foto/descarga.webp" alt="">
      <p>Tipo: Gato</p>
      <p>Raza: Siamés</p>
      <p>Edad: 1 año</p>
      <button class="adopt-btn">Adoptar a Milo</button>
    </div>
    <div class="pet-card">
      <h3>Rocky</h3>
      <p>Tipo: Perro</p>
      <p>Raza: Pastor Alemán</p>
      <p>Edad: 3 años</p>
      <button class="adopt-btn">Adoptar a Rocky</button>
    </div>
  </div>
</div>

<!-- Pie de contacto -->
<footer>
  <div class="contacto">
    <h3>Contacto</h3>
    <p>Si tienes alguna pregunta sobre el proceso de adopción, no dudes en contactarnos:</p>
    <p>Email: adopciones@rescatardemascotas.com</p>
    <p>Teléfono: +34 123 456 789</p>
    <p>¡Gracias por ayudar a nuestras mascotas!</p>
  </div>
</footer>

</body>
</html>
