@extends('layouts.app')

@section('styles')
<style>
    .card {
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        border: none;
        border-radius: 15px;
    }

    .card-header {
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        color: white;
        border-radius: 15px 15px 0 0 !important;
        padding: 1.5rem;
    }

    .form-label {
        font-weight: 600;
        color: #333;
        margin-bottom: 0.5rem;
    }

    .form-control, .form-select {
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        padding: 0.75rem;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: #2575fc;
        box-shadow: 0 0 0 0.2rem rgba(37,117,252,0.25);
    }

    .btn-primary {
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        border: none;
        padding: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(37,117,252,0.3);
    }

    .btn-secondary {
        background: #6c757d;
        border: none;
        padding: 12px;
    }

    .alert-danger {
        border-left: 4px solid #dc3545;
        border-radius: 8px;
    }

    .img-preview {
        border-radius: 10px;
        border: 3px solid #e0e0e0;
        padding: 3px;
    }

    textarea {
        min-height: 100px;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    @media (max-width: 768px) {
        .container {
            padding: 10px;
        }

        .card {
            border-radius: 10px;
        }
    }
</style>
@endsection

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center mb-0">Editar Reporte de Mascota Perdida</h3>
                </div>

                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger mb-4">
                            <strong>Por favor corrige los siguientes errores:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('perdidos.update', $perdido->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre de la Mascota:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre"
                                   value="{{ old('nombre', $perdido->nombre) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="especie" class="form-label">Especie:</label>
                            <select class="form-select" id="especie" name="especie" required>
                                <option value="perro" {{ old('especie', $perdido->especie) == 'perro' ? 'selected' : '' }}>Perro</option>
                                <option value="gato" {{ old('especie', $perdido->especie) == 'gato' ? 'selected' : '' }}>Gato</option>
                                <option value="otro" {{ old('especie', $perdido->especie) == 'otro' ? 'selected' : '' }}>Otro</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción:</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required>{{ old('descripcion', $perdido->descripcion) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="ubicacion" class="form-label">Última ubicación vista:</label>
                            <input type="text" class="form-control" id="ubicacion" name="ubicacion"
                                   value="{{ old('ubicacion', $perdido->ubicacion) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="fecha_perdida" class="form-label">Fecha de pérdida:</label>
                            <input type="date" class="form-control" id="fecha_perdida" name="fecha_perdida"
                                   value="{{ old('fecha_perdida', $perdido->fecha_perdida) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="contacto" class="form-label">Información de contacto:</label>
                            <input type="text" class="form-control" id="contacto" name="contacto"
                                   value="{{ old('contacto', $perdido->contacto) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado:</label>
                            <select class="form-select" id="estado" name="estado" required>
                                <option value="perdido" {{ old('estado', $perdido->estado) == 'perdido' ? 'selected' : '' }}>Perdido</option>
                                <option value="encontrado" {{ old('estado', $perdido->estado) == 'encontrado' ? 'selected' : '' }}>Encontrado</option>
                            </select>
                        </div>

                        @if ($perdido->imagen)
                            <div class="mb-4">
                                <label class="form-label d-block">Imagen Actual:</label>
                                <img src="{{ asset('storage/' . $perdido->imagen) }}"
                                     alt="Imagen de {{ $perdido->nombre }}"
                                     class="img-fluid mb-2 img-preview"
                                     style="max-height: 200px;">
                            </div>
                        @endif

                        <div class="mb-3">
                            <label for="imagen" class="form-label">Actualizar Imagen:</label>
                            <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
                        </div>

                        <div class="d-grid gap-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Actualizar Reporte
                            </button>
                            <a href="{{ route('perdidos.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Volver al Listado
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Preview de imagen
    document.getElementById('imagen').addEventListener('change', function(e) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.createElement('img');
            preview.src = e.target.result;
            preview.className = 'img-fluid mb-2 img-preview';
            preview.style.maxHeight = '200px';

            const container = document.querySelector('.img-preview-container');
            container.innerHTML = '';
            container.appendChild(preview);
        }
        reader.readAsDataURL(e.target.files[0]);
    });
</script>
@endsection
