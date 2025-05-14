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

            @if($perdido->estado === 'perdido')
                <div class="mt-4 text-center">
                    <button type="button" class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#reportarEncontradaModal">
                        <i class="fas fa-check-circle me-2"></i>Reportar como encontrada
                    </button>
                </div>

                <!-- Modal para reportar mascota encontrada -->
                <div class="modal fade" id="reportarEncontradaModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-success text-white">
                                <h5 class="modal-title">Reportar mascota encontrada</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('perdidos.encontrada', $perdido->id) }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <p>Vas a reportar que has encontrado a <strong>{{ $perdido->nombre }}</strong>.</p>
                                    <p>Esta acción enviará una notificación al dueño de la mascota.</p>

                                    <div class="mb-3">
                                        <label for="ubicacion" class="form-label">Ubicación donde la encontraste:</label>
                                        <input type="text" class="form-control" id="ubicacion" name="ubicacion" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="detalles" class="form-label">Detalles adicionales:</label>
                                        <textarea class="form-control" id="detalles" name="detalles" rows="3"
                                                  placeholder="Describe cómo, cuándo o en qué condiciones encontraste a la mascota"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-success">Confirmar y notificar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <div class="alert alert-success mt-4">
                    <i class="fas fa-check-circle me-2"></i>Esta mascota ya ha sido reportada como encontrada.
                </div>
            @endif
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
