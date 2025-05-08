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

<style>
/* Estilo general del contenedor */
.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f9f9f9; /* Fondo claro */
    border-radius: 10px; /* Bordes redondeados */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra suave */
}

/* Título del formulario */
.container h2 {
    text-align: center;
    color: #333; /* Color del texto */
    font-family: 'Arial', sans-serif;
    margin-bottom: 20px;
}

/* Estilo para las etiquetas */
.form-label {
    font-weight: bold;
    color: #555;
    font-size: 1rem;
}

/* Estilo para los campos de entrada */
.form-control {
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 10px;
    font-size: 1rem;
    transition: border-color 0.3s ease;
}

.form-control:focus {
    border-color: #007bff; /* Color azul al enfocar */
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

/* Estilo para el botón principal */
.btn-primary {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    font-size: 1rem;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-primary:hover {
    background-color: #0056b3;
}

/* Estilo para el botón secundario */
.btn-secondary {
    background-color: #6c757d;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    font-size: 1rem;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-secondary:hover {
    background-color: #5a6268;
}

/* Estilo para el área de texto */
textarea.form-control {
    resize: none; /* Evita que el usuario cambie el tamaño */
}

/* Estilo para las alertas de error */
.alert-danger {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
    border-radius: 5px;
    padding: 10px;
    margin-bottom: 20px;
}

/* Estilo para la lista de errores */
.alert-danger ul {
    margin: 0;
    padding: 0;
    list-style: none;
}

/* Espaciado entre los campos */
.mb-3 {
    margin-bottom: 20px;
}
</style>

