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

            background-color: #007bff;
            color: white;
            text-align: center;
            padding: 3cm 20px;
        }

        .hero-section h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        .hero-section p {
            font-size: 1.2rem;
        }

        .hero-section .btn {
            margin-top: 20px;
            background-color: #ffc107;
            color: black;
            font-weight: bold;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
        }

        .hero-section .btn:hover {
            background-color: #e0a800;
        }

        .filters {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin: 20px 0;
        }

        .filters input,
        .filters select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
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
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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
            font-size: 1.5rem;
            margin: 10px 0;
        }

        .pet-card p {
            margin: 5px 0;
            font-size: 1rem;
        }

        .pet-card .adopt-btn {
            display: block;
            background-color: #28a745;
            color: white;
            padding: 10px;
            margin: 10px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }

        .pet-card .adopt-btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <!-- Hero Section -->

    <div class="hero-section">
        <h1>Adopción de Perros y Gatos</h1>
        <p>Busca por las características de la mascota que deseas adoptar</p>
        <a href="{{ route('mascotas.create') }}" class="btn">Publica una mascota</a>
    </div>
<
    <!-- Filtros -->
    <div class="filters">
        <select>
            <option value="">¿Qué especie?</option>
            <option value="perro">Perro</option>
            <option value="gato">Gato</option>
        </select>
        <select>
            <option value="">¿Qué tamaño?</option>
            <option value="pequeño">Pequeño</option>
            <option value="mediano">Mediano</option>
            <option value="grande">Grande</option>
        </select>
        <select>
            <option value="">¿Qué género?</option>
            <option value="macho">Macho</option>
            <option value="hembra">Hembra</option>
        </select>
        <input type="text" placeholder="Por nombre">
        <input type="text" placeholder="¿Cuál ciudad?">
    </div>

    <!-- Lista de Mascotas -->
    <div class="pets-container">
        @foreach ($mascotas as $mascota)
            <div class="pet-card">
                <img src="{{ $mascota->imagen ? ('storage/' . $mascota->imagen) : 'https://via.placeholder.com/300x200' }}" alt="Imagen de {{ $mascota->nombre }}">
                <h3>{{ $mascota->nombre }}</h3>
                <p><strong>Especie:</strong> {{ $mascota->especie }}</p>
                <p><strong>Edad:</strong> {{ $mascota->edad }} años</p>
                <p><strong>cuidador temporal:</strong> {{ $mascota->usuario->nombre ?? 'Sin usuario' }} </p>
                <a href="{{ route('mascotas.show', $mascota->id) }}" class="adopt-btn">Adoptar a {{ $mascota->nombre }}</a>
            </div>
        @endforeach
    </div>
</body>
</html>
@endsection
