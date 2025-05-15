<!-- filepath: c:\xampp\htdocs\Pets-Waiting\resources\views\notificaciones\show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">
                        @if($notificacion->tipo == 'encontrado')
                            <i class="fas fa-search text-light me-2"></i>Mascota Encontrada
                        @elseif($notificacion->tipo == 'adopcion')
                            <i class="fas fa-heart text-light me-2"></i>Solicitud de Adopción
                        @elseif($notificacion->tipo == 'adopcion_aprobada')
                            <i class="fas fa-check-circle text-light me-2"></i>Adopción Aprobada
                        @elseif($notificacion->tipo == 'adopcion_rechazada')
                            <i class="fas fa-times-circle text-light me-2"></i>Adopción Rechazada
                        @else
                            <i class="fas fa-bell text-light me-2"></i>Notificación
                        @endif
                    </h3>
                    <span class="badge bg-light text-dark">
                        {{ $notificacion->created_at->format('d/m/Y H:i') }}
                    </span>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Mensaje principal de la notificación -->
                    <div class="alert alert-info">
                        <p class="mb-0" style="white-space: pre-line;">{{ $notificacion->mensaje }}</p>
                    </div>

                    <!-- Detalles de mascota perdida encontrada -->
                    @if($notificacion->tipo == 'encontrado' && isset($perdido))
                        <div class="card mb-4">
                            <div class="card-header bg-success text-white">
                                <h4 class="mb-0">Detalles de la mascota encontrada</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        @if($perdido->imagen)
                                            <img src="{{ asset('storage/' . $perdido->imagen) }}"
                                                alt="{{ $perdido->nombre }}"
                                                class="img-fluid rounded mb-3">
                                        @else
                                            <div class="text-center p-4 bg-light rounded mb-3">
                                                <i class="fas fa-paw fa-3x text-muted"></i>
                                            </div>
                                        @endif
                                        <h5>{{ $perdido->nombre }}</h5>
                                        <p><strong>Especie:</strong> {{ ucfirst($perdido->especie) }}</p>
                                    </div>

                    <!-- Detalles de solicitud de adopción -->
                    @if($notificacion->tipo == 'adopcion' && isset($adopcion))
                        <div class="card mb-4">
                            <div class="card-header bg-danger text-white">
                                <h4 class="mb-0">Detalles de la solicitud de adopción</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        @if($adopcion->mascota->imagen)
                                            <img src="{{ asset('storage/' . $adopcion->mascota->imagen) }}"
                                                alt="{{ $adopcion->mascota->nombre }}"
                                                class="img-fluid rounded mb-3">
                                        @else
                                            <div class="text-center p-4 bg-light rounded mb-3">
                                                <i class="fas fa-paw fa-3x text-muted"></i>
                                            </div>
                                        @endif
                                        <h5>{{ $adopcion->mascota->nombre }}</h5>
                                        <p><strong>Especie:</strong> {{ ucfirst($adopcion->mascota->especie) }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="border-bottom pb-2">Datos del solicitante</h5>
                                        <p><strong>Nombre:</strong> {{ $adopcion->nombre }}</p>
                                        <p><strong>Email:</strong> {{ $adopcion->email }}</p>
                                        <p><strong>Teléfono:</strong> {{ $adopcion->telefono }}</p>
                                        <p><strong>Ciudad:</strong> {{ $adopcion->ciudad }}</p>
                                        <p><strong>Ocupación:</strong> {{ $adopcion->ocupacion }}</p>
                                        <p><strong>Motivo:</strong></p>
                                        <div class="p-3 bg-light rounded">
                                            {{ $adopcion->porque }}
                                        </div>
                                    </div>
                                </div>

                                @if($adopcion->estado == 'pendiente')
                                    <div class="d-flex justify-content-center gap-3 mt-3">
                                        <a href="{{ route('mascotas.show', $adopcion->mascota_id) }}" class="btn btn-primary">
                                            <i class="fas fa-eye me-2"></i>Ver mascota
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>

                <div class="card-footer bg-white d-flex justify-content-between">
                    <a href="{{ route('notificaciones.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Volver a notificaciones
                    </a>

                    <form action="{{ route('notificaciones.eliminar', $notificacion->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger"
                                onclick="return confirm('¿Estás seguro de eliminar esta notificación?')">
                            <i class="fas fa-trash me-2"></i>Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
