@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adopción de Mascotas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .hero-section {
            background-image: url('img/newpatas.jpg');
            background-size: cover;
            background-position: center;
            height: 70vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: #fff;
            padding:1cm 30px;
        }

        .hero-section h1 {
            color: #fff;
            padding: 0cm;
            font-size: 3.8rem;
            margin-bottom: 1rem;
            font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif
        }

        .hero-section p {
            font-size: 1.2rem;
            padding: 1rem 1rem;
            margin-bottom: 1rem;
            color: #fff;
            font: 1em sans-serif;

        }

        .hero-section .btn {
            margin-top: 20px;
            background-color: #2234ff;
            color: white;
            font-weight: bold;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-decoration: none;

        }

        .hero-section .btn:hover {
            background-color: #d81b60;
        }

        .filters {
            color:rgb(250, 248, 250);
            display: flex;
            justify-content: center;
            gap: 10px;
            margin: 20px 0;
            font-family:fantasy
        }

        .filters input[type="text"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
            font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif
        }
        .filters select {
            background-color: #2234ff;
            color:rgb(250, 248, 249);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
            font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif
        }

        .pets-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            padding: 20px;
        }

        .pet-card {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 6pxrgb(165, 42, 136);
            width: 300px;
            overflow: hidden;
            text-align: center;

        }

        .pet-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .pet-card h3 {

            color:#000000;
    font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            font-size: 1.5rem;
            margin: 10px 0;
        }

        .pet-card p {
            color: #000000;
    font-family:Arial, Helvetica, sans-serif;
            margin: 5px 0;
            font-size: 1rem;
        }

        .pet-card .adopt-btn {
            display: block;
            background-color: #2234ff;
            color: white;
            padding: 10px;
            margin: 10px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }

        .pet-card .adopt-btn:hover {
            background-color: #d81b60;
        }
    </style>
</head>
<body>
    <!-- Hero Section -->

    <div class="hero-section">
        <h1>ADOPCION DE PERROS Y GATOS</h1>
        <p>Busca por las características de la mascota que deseas adoptar.</p>
        @auth
            <a href="{{ url('/publicar-mascota') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Publicar una mascota
            </a>
        @else
            <a href="{{ route('login') }}" class="btn btn-primary">
                <i class="fas fa-sign-in-alt"></i> Inicia sesión para publicar
            </a>
        @endauth
    </div>



    <!-- Lista de Mascotas -->
    <div class="pets-container">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($mascotas->isEmpty())
            <div class="alert alert-info">
                No hay mascotas disponibles para adopción en este momento.
            </div>
        @else
            @foreach($mascotas as $mascota)
                <div class="pet-card">
                    <img src="{{ $mascota->imagen ? asset('storage/' . $mascota->imagen) : asset('images/default-pet.jpg') }}"
                         alt="Foto de {{ $mascota->nombre }}">
                    <h3>{{ $mascota->nombre }}</h3>
                    <p>Especie: {{ ucfirst($mascota->especie) }}</p>
                    <p>Edad: {{ $mascota->edad }} años</p>
                    <a href="{{ route('mascotas.show', $mascota->id) }}" class="btn btn-primary">
                        Ver detalles
                    </a>
                </div>
            @endforeach
        @endif
    </div>
</body>
</html>
@endsection
