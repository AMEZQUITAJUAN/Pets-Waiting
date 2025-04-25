@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rescate de Mascotas</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="{{ asset('styles.css') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <section class="hero">
        <div class="hero-content">
            <h1>Dale un hogar a una <span>mascota necesitada</span></h1>
            <p>Juntos podemos salvar vidas y crear familias felices. Adopta, no compres.</p>
            <div class="hero-buttons">
                <button class="adoptar">Adoptar ahora</button>
                <button class="donar">Hacer una donación</button>
            </div>
        </div>
        <div class="hero-image">
            <img src="img/mascotas.png" alt="Mascota feliz">
        </div>
    </section>

  <section class="servicios">
    <h2>Nuestros servicios</h2>
    <div class="cards">
      <div class="card">
        <div class="icon">🏠</div>
        <h3>Adopción</h3>
        <p>Encuentra tu compañero perfecto entre nuestras mascotas rescatadas.</p>
      </div>
      <div class="card">
        <div class="icon">💚</div>
        <h3>Cuidado temporal</h3>
        <p>Ofrece un hogar temporal a una mascota necesitada.</p>
      </div>
      <div class="card">
        <div class="icon">🔍</div>
        <h3>Búsqueda de mascotas perdidas</h3>
        <p>Te ayudamos a encontrar a tu mascota perdida.</p>
      </div>
    </div>
  </section>

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

    @endsection
