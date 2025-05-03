@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">¿Por qué Adoptar una Mascota?</h1>

    <div class="card mb-4">
        <div class="card-body">
            <h3 class="card-title">¿Por qué quieres una mascota?</h3>
            <p class="card-text">
                Es importante pensar en la razón principal para querer compartir tu hogar con una mascota. Adoptar un animal simplemente para que cuide la casa o por capricho de los niños generalmente termina en un gran error. 
                Debes tener en cuenta que algunas mascotas pueden estar contigo 10, 15 o incluso 20 años.
            </p>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <h3 class="card-title">¿Tienes tiempo para una mascota?</h3>
            <p class="card-text">
                Además de ser alimentados, perros y gatos necesitan de tu compañía, cariño y atención. Es importante considerar el tiempo que tendrás disponible para tu mascota. 
                Muchos animales terminan siendo abandonados porque sus dueños no pensaron en el factor tiempo.
            </p>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <h3 class="card-title">¿Eres económicamente capaz de tener una mascota?</h3>
            <p class="card-text">
                Comida, asistencia veterinaria, medicamentos, juguetes, vacunas, todos estos son gastos que se deben asumir cuando se está a cargo de una mascota, 
                además de los daños que pueden llegar a ocasionar en los muebles y cosas de tu hogar.
            </p>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <h3 class="card-title">¿Es tu hogar un sitio apto para tener mascota?</h3>
            <p class="card-text">
                Es importante que todos los miembros de la familia estén de acuerdo con la llegada de una mascota. Debes considerar si hay personas alérgicas o que no puedan convivir con perros o gatos. 
                También debes tener identificado un sitio apto para que tu nueva mascota haga sus necesidades.
            </p>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <h3 class="card-title">¿Serás un dueño responsable?</h3>
            <p class="card-text">
                Debes estar dispuesto a aceptar al animal como un nuevo integrante de la familia quien merece todo el amor y respeto. 
                Además, debes cumplir con ciertas normas comunitarias que harán que tu mascota pueda convivir sin problemas con las personas que lo rodean.
            </p>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('adopcion') }}" class="btn btn-primary">Encuentra tu Mascota</a>
    </div>
</div>
@endsection