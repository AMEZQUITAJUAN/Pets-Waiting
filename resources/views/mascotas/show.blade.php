@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <!-- Imagen de la mascota -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <img src="{{ $mascota->imagen ? asset('storage/' . $mascota->imagen) : 'https://via.placeholder.com/600x400' }}" 
                     alt="Imagen de {{ $mascota->nombre }}" 
                     class="img-fluid rounded">
            </div>
        </div>

        <!-- Detalles de la mascota -->
        <div class="col-md-6">
            <h1 class="text-primary fw-bold">{{ $mascota->nombre }}</h1>
            <div class="d-flex gap-2 mb-3">
                <a href="{{ route('adopcion.create', ['mascota' => $mascota->id]) }}" class="btn btn-primary">Adoptar</a>
                <a href="#" class="btn btn-outline-danger btn-lg">Compartir</a>
            </div>

            <ul class="list-unstyled">
                <li class="mb-2"><strong>Género:</strong> <span class="text-secondary">{{ ucfirst($mascota->genero ?? 'No especificado') }}</span></li>
                <li class="mb-2"><strong>Tamaño:</strong> <span class="text-secondary">{{ ucfirst($mascota->tamano ?? 'No especificado') }}</span></li>
                <li class="mb-2"><strong>Edad:</strong> <span class="text-secondary">{{ $mascota->edad }} años</span></li>
                <li class="mb-2"><strong>Esterilizado/Castrado:</strong> <span class="text-secondary">{{ $mascota->esterilizado ? 'Sí' : 'No' }}</span></li>
                <li class="mb-2"><strong>Ubicación:</strong> <span class="text-secondary">{{ $mascota->ubicacion ?? 'No especificada' }}</span></li>
            </ul>

            <p class="mt-3 text-muted">
                {{ $mascota->descripcion ?? 'No hay descripción disponible para esta mascota.' }}
            </p>

            <!-- Información de contacto -->
            <h4 class="mt-4 text-primary">Contacto:</h4>
            <div class="card shadow-sm p-3">
                <p class="mb-1"><strong>Nombre:</strong> {{ $mascota->usuario->nombre ?? 'No especificado' }}</p>
                <p class="mb-1"><strong>Email:</strong> {{ $mascota->usuario->email ?? 'No especificado' }}</p>
                <p class="mb-0"><strong>Teléfono:</strong> {{ $mascota->usuario->telefono ?? 'No especificado' }}</p>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border: none;
        border-radius: 10px;
    }

    .btn-lg {
        font-size: 1.2rem;
        padding: 0.5rem 1.5rem;
    }

    .text-primary {
        color: #007bff !important;
    }

    .text-secondary {
        color: #6c757d !important;
    }

    .shadow-sm {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
</style>
@endsection
