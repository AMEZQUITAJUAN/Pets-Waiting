@extends('layouts.app')

@section('content')


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pets Waiting</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Rescate de Mascotas</h1>
        <p>Dale un hogar a una mascota necesaria</p>
        <p>Juntos podemos salvar vidas y crear familias felices. Adopta, no compres.</p>
        <a class="btn" href="#adoptar">Adoptar ahora</a>
        <a class="btn" href="#donar">Haz una donación</a>
    </header>

    <section class="services">
        <h2>Nuestros servicios</h2>
        <div class="service">
            <h3>Adopción</h3>
            <p>Encuentra tu compañero perfecto entre nuestras mascotas rescatadas.</p>
        </div>
        <div class="service">
            <h3>Cuidado temporal</h3>
            <p>Ofrece un lugar temporal a una mascota necesitada.</p>
        </div>
        <div class="service">
            <h3>Búsqueda de mascotas perdidas</h3>
            <p>Te ayudamos a encontrar a tu mascota perdida.</p>
        </div>
    </section>

    <footer>
        <h2>Únete a nuestra causa</h2>
        <p>Ingresa tu correo electrónico:</p>
        <input type="email" placeholder="Tu correo electrónico">
        <button class="subscribe">Suscribirme al boletín</button>
    </footer>
</body>
</html>


    @endsection
