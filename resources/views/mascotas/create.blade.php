@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Registrar una Nueva Mascota</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('mascotas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Campos existentes -->
        <div class="mb-3">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
        </div>

        <div class="mb-3">
            <label for="especie">Especie:</label>
            <select class="form-control" id="especie" name="especie" required>
                <option value="">Seleccione una especie</option>
                <option value="perro" {{ old('especie') == 'perro' ? 'selected' : '' }}>Perro</option>
                <option value="gato" {{ old('especie') == 'gato' ? 'selected' : '' }}>Gato</option>
                <option value="otro" {{ old('especie') == 'otro' ? 'selected' : '' }}>Otro</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="edad">Edad:</label>
            <input type="number" class="form-control" id="edad" name="edad" value="{{ old('edad') }}" min="0" required>
        </div>

        <div class="mb-3">
            <label for="usuario_id">Usuario Asociado:</label>
            <select class="form-control" id="usuario_id" name="usuario_id" required>
                <option value="">Seleccione un usuario</option>
                @foreach ($usuarios as $usuario)
                    <option value="{{ $usuario->id }}" {{ old('usuario_id') == $usuario->id ? 'selected' : '' }}>
                        {{ $usuario->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Campo para la imagen -->
        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen de la mascota:</label>
            <input type="file"
                   class="form-control @error('imagen') is-invalid @enderror"
                   id="imagen"
                   name="imagen"
                   accept="image/*">
            @error('imagen')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Vista previa de la imagen -->
        <div class="mb-3">
            <img id="preview" src="#" alt="Vista previa" style="display: none; max-width: 200px; margin-top: 10px;">
        </div>

        <!-- Para mostrar imágenes en cualquier vista -->
        @if($mascota->imagen)
            <img src="{{ Storage::url($mascota->imagen) }}"
                 class="card-img-top"
                 alt="Imagen de {{ $mascota->nombre }}">
        @else
            <img src="https://via.placeholder.com/300x200"
                 class="card-img-top"
                 alt="Sin imagen">
        @endif

        <button type="submit" class="btn btn-primary">Registrar Mascota</button>
        <a href="{{ route('mascotas.index') }}" class="btn btn-secondary">Volver</a>
    </form>
</div>

<!-- Script para vista previa de la imagen -->
<script>
document.getElementById('imagen').onchange = function(e) {
    const preview = document.getElementById('preview');
    preview.style.display = 'block';
    preview.src = URL.createObjectURL(e.target.files[0]);
};
</script>
@endsection

