@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <!-- Imagen de la mascota perdida -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <img src="{{ $perdido->imagen ? asset('storage/' . $perdido->imagen) : 'https://via.placeholder.com/600x400' }}" 
                     alt="Imagen de {{ $perdido->nombre }}" 
                     class="img-fluid rounded">
            </div>
        </div>

        <!-- Detalles de la mascota perdida -->
        <div class="col-md-6">
            <h1 class="text-primary fw-bold">{{ $perdido->nombre }}</h1>
            <ul class="list-unstyled">
                <li class="mb-2"><strong>Especie:</strong> <span class="text-secondary">{{ ucfirst($perdido->especie ?? 'No especificado') }}</span></li>
                <li class="mb-2"><strong>Género:</strong> <span class="text-secondary">{{ ucfirst($perdido->genero ?? 'No especificado') }}</span></li>
                <li class="mb-2"><strong>Edad:</strong> <span class="text-secondary">{{ $perdido->edad ?? 'No especificada' }}</span></li>
                <li class="mb-2"><strong>Ubicación:</strong> <span class="text-secondary">{{ $perdido->ubicacion ?? 'No especificada' }}</span></li>
                <li class="mb-2"><strong>Fecha de Pérdida:</strong> <span class="text-secondary">{{ $perdido->fecha_perdida ?? 'No especificada' }}</span></li>
            </ul>

            <p class="mt-3 text-muted">
                {{ $perdido->descripcion ?? 'No hay descripción disponible para esta mascota perdida.' }}
            </p>

            <!-- Información de contacto -->
            <h4 class="mt-4 text-primary">Contacto:</h4>
            <div class="card shadow-sm p-3">
                <p class="mb-1"><strong>Nombre:</strong> {{ $perdido->contacto_nombre ?? 'No especificado' }}</p>
                <p class="mb-1"><strong>Email:</strong> {{ $perdido->contacto_email ?? 'No especificado' }}</p>
                <p class="mb-0"><strong>Teléfono:</strong> {{ $perdido->contacto_telefono ?? 'No especificado' }}</p>
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