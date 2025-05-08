@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Reportar Mascota Perdida</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('perdidos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre de la mascota</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>

        <div class="mb-3">
            <label for="especie" class="form-label">Especie</label>
            <select class="form-control" id="especie" name="especie" required>
                <option value="">Selecciona una especie</option>
                <option value="perro">Perro</option>
                <option value="gato">Gato</option>
                <option value="otro">Otro</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="raza" class="form-label">Raza</label>
            <input type="text" class="form-control" id="raza" name="raza">
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label for="ubicacion" class="form-label">Ubicación donde se perdió</label>
            <input type="text" class="form-control" id="ubicacion" name="ubicacion" required>
        </div>

        <div class="mb-3">
            <label for="fecha_perdida" class="form-label">Fecha cuando se perdió</label>
            <input type="date" class="form-control" id="fecha_perdida" name="fecha_perdida" required>
        </div>

        <div class="mb-3">
            <label for="contacto" class="form-label">Información de contacto</label>
            <input type="text" class="form-control" id="contacto" name="contacto" required
                   placeholder="Teléfono o correo electrónico">
        </div>

        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen de la mascota</label>
            <input type="file" class="form-control" id="imagen" name="imagen">
        </div>

        <button type="submit" class="btn btn-primary">Reportar Mascota</button>
        <a href="{{ route('perdidos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
