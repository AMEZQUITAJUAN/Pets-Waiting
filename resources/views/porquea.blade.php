@extends('layouts.app')
@section('content')
{{-- Aquí puedes agregar el contenido específico de la vista --}}   

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
        .why { background-color:rgb(255, 255, 255); }
        .time { background-color:rgb(104, 178, 228); }
        .economical { background-color:rgb(255, 255, 255); }
        .home { background-color:rgb(248, 121, 131); }
        .responsible { background-color:rgb(255, 255, 255); }
        .find { background-color: #4eb0a0; }
        .titulo-por-que {
  color:rgb(125, 197, 255); 
}

.titulo-tiempo {
  color:rgb(109, 247, 183); 
}

.titulo-economico {
    color:rgb(125, 197, 255); 
}

    .titulo-hogar{
        color:rgb(109, 247, 183);
}
.titulo-dueño{
    color:rgb(66, 149, 218);
}
.titulo-encuentra{
    color:rgb(109, 247, 183); 
}
.texto-por-que {
    color:rgb(125, 197, 255); 
}
.texto-tiempo{
    color:rgb(109, 247, 183);
}
.texto-economico{
    color:rgb(92, 177, 247); 
}
.texto-hogar{
    color:rgb(109, 247, 183);
}
.texto-dueño{
    color:rgb(66, 149, 218);
}

h2 {
        text-align: center;
        margin-bottom: 15px;
        color: blue;
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
        .centered-button .btn {
    background-color: #007bff !important; /* Fuerza el color azul */
    color: #fff;
    padding: 10px;
    text-align: center;
    border-radius: 5px;
    text-decoration: none;
}

.centered-button .btn:hover {
    background-color: #0056b3 !important; /* Azul más oscuro al pasar el mouse */
}
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
        .centered-button {
        text-align: center; /* Centra el botón dentro del contenedor */
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
        <h2 class="titulo-por-que">¿Por Qué Quieres Una Mascota?</h2>
        <div class="center">
            {{-- Agrega la imagen si tienes una local o URL --}}
            <img src="{{ asset('img/mascotas1.jpg') }}" alt="Mascotas"> {{-- o usa una URL --}}
        </div>
        <p class="texto-por-que">Es importante pensar en la razón principal para querer adoptar un animal para asegurarte de que estás listo para brindarle un hogar responsable y amoroso. Tener una mascota requiere compromiso y cuidado constante para su bienestar.</p>
    </section>

  
    <section class="section time">
    <h2 class="titulo-tiempo">¿Tienes Tiempo Para Una Mascota?</h2>
        <div class="center">
            <img src="{{ asset('img/tiempo.png') }}" alt="Tiempo para mascotas">
        </div>
        <p class="texto-tiempo">Dedicar tiempo a cuidar, jugar y atender a tu mascota es fundamental. Antes de adoptar, verifica que tienes suficiente disponibilidad para que tu nuevo amigo no se sienta solo o desatendido.</p>
    </section>

    
    <section class="section economical">
        <h2 class="titulo-economico">¿Eres Económicamente Capaz De Tener Una Mascota?</h2>
        <div class="center">
            <img src="{{ asset('img/mascotas2.png') }}" alt="Economía para mascotas">
        </div>
        <p class="texto-economico">Los gastos veterinarios, alimentación, higiene y cuidados adicionales suman. Es importante que puedas hacerle frente a estos gastos para garantizar su bienestar y salud.</p>
    </section>

    
    <section class="section home">
        <h2 class="titulo-hogar">¿Es Tu Hogar Un Sitio Apto Para Tener Mascota?</h2>
        <div class="center">
            <img src="{{ asset('img/hogar.png') }}" alt="Hogar apto para mascotas">
        </div>
        <p class="texto-hogar">El espacio, las condiciones y las reglas del hogar deben ser adecuados para la mascota que deseas adoptar. Un ambiente seguro y confortable es esencial para su bienestar.</p>
    </section>

   
    <section class="section responsible">
        <h2 class="titulo-dueño">¿Serás Un Dueño Responsable?</h2>
        <div class="center">
            <img src="{{ asset('img/respon.jpg') }}" alt="Responsabilidad de tu mascotas">
        </div>
        <p class="titulo-dueño">Adoptar conlleva compromiso y dedicación a largo plazo. La responsabilidad incluye cuidado diario, visitas al veterinario y mucho amor.</p>
    </section>

   
    <section class="section find">
        <h2 class="titulo-encuentra">Encuentra Tu Mascota</h2>
        <div class="center">
            <img src="{{ asset('img/dog.png') }}" alt="Encuentra tus mascotas">
        </div>
        <p>Ahora puedes empezar a buscar a tu nuevo amigo. ¡Adopta y dale una segunda oportunidad!</p>
        <div class="centered-button">
            <a href="{{ route('adopcion') }}" class="btn">Ver mascotas</a>
        </div>
    </section>

</body>
</html>
