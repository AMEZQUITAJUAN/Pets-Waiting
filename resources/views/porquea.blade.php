<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Adopta una Mascota</title>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        .section {
            padding: 20px;
            color: #fff;
        }

        /* Colores según categoría */
        .why { background-color: #b4b4b4; }
        .time { background-color: #83d0d0; }
        .economical { background-color: #57b358; }
        .home { background-color: #f87983; }
        .responsible { background-color: #46689c; }
        .find { background-color: #4eb0a0; }

        h2 {
            text-align: center;
            margin-bottom: 15px;
        }

        .center {
            display: flex;
            justify-content: center;
            margin-bottom: 15px;
        }

        /* Estilos para las imágenes */
        img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        /* Botón */
        .btn {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            text-align: center;
            border-radius: 5px;
            text-decoration: none;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        /* Texto y descripciones */
        p {
            max-width: 800px;
            margin: 0 auto 15px auto;
            font-size: 1.1em;
        }
    </style>
</head>
<body>


    <section class="section why">
        <h2>¿POR QUÉ QUIERES UNA MASCOTA?</h2>
        <div class="center">
            {{-- Agrega la imagen si tienes una local o URL --}}
            <img src="{{ asset('images/mascota1.jpg') }}" alt="Mascota"> {{-- o usa una URL --}}
        </div>
        <p>Es importante pensar en la razón principal para querer adoptar un animal para asegurarte de que estás listo para brindarle un hogar responsable y amoroso. Tener una mascota requiere compromiso y cuidado constante para su bienestar.</p>
    </section>

  
    <section class="section time">
        <h2>¿TIENES TIEMPO PARA UNA MASCOTA?</h2>
        <div class="center">
            <img src="{{ asset('images/mascota2.jpg') }}" alt="Tiempo para mascota">
        </div>
        <p>Dedicar tiempo a cuidar, jugar y atender a tu mascota es fundamental. Antes de adoptar, verifica que tienes suficiente disponibilidad para que tu nuevo amigo no se sienta solo o desatendido.</p>
    </section>

    
    <section class="section economical">
        <h2>¿ERES ECONÓMICAMENTE CAPAZ DE TENER UNA MASCOTA?</h2>
        <div class="center">
            <img src="{{ asset('images/mascota3.jpg') }}" alt="Economía">
        </div>
        <p>Los gastos veterinarios, alimentación, higiene y cuidados adicionales suman. Es importante que puedas hacerle frente a estos gastos para garantizar su bienestar y salud.</p>
    </section>

    
    <section class="section home">
        <h2>¿ES TU HOGAR UN SITIO APTO PARA TENER MASCOTA?</h2>
        <div class="center">
            <img src="{{ asset('images/mascota4.jpg') }}" alt="Hogar apto">
        </div>
        <p>El espacio, las condiciones y las reglas del hogar deben ser adecuados para la mascota que deseas adoptar. Un ambiente seguro y confortable es esencial para su bienestar.</p>
    </section>

   
    <section class="section responsible">
        <h2>¿ERÁS UNA ONDUE RESPONSABLE?</h2>
        <div class="center">
            <img src="{{ asset('images/mascota5.jpg') }}" alt="Responsabilidad">
        </div>
        <p>Adoptar conlleva compromiso y dedicación a largo plazo. La responsabilidad incluye cuidado diario, visitas al veterinario y mucho amor.</p>
    </section>

   
    <section class="section find">
        <h2>ENCUENTRA TU MASCOTA</h2>
        <div class="center">
            <img src="{{ asset('images/mascota6.jpg') }}" alt="Encuentra tu mascota">
        </div>
        <p>Ahora puedes empezar a buscar a tu nuevo amigo. ¡Adopta y dale una segunda oportunidad!</p>
        <a href="{{ route('mascotas.index') }}" class="btn">Ver mascotas</a>
    </section>

</body>
</html>
