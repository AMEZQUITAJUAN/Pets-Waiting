@extends('layouts.app') {{-- si tienes un layout --}}

@section('content')

<div class="form-section">
    <h2 style="text-align: center; color: blue;">Solicitud de Adopción</h2>

    {{-- Mostrar mensaje de éxito si existe --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('adopciones.store') }}" method="POST" id="adopcionForm">
        @csrf
        <!-- Campo oculta para la mascota -->
        <input type="hidden" name="mascota_id" value="{{ $mascota->id }}">
        <p>Estás adoptando a: {{ $mascota->nombre }}</p>

        {{-- Datos personales --}}
        <label for="nombre">Nombre completo</label>
        <input type="text" name="nombre" id="nombre" placeholder="Tu nombre" required />

        <label for="email">Correo electrónico</label>
        <input type="email" name="email" id="email" placeholder="tu@email.com" required />

        <label for="telefono">Teléfono</label>
        <input type="text" name="telefono" id="telefono" placeholder="Número de teléfono" required />

        {{-- Datos de localización y ocupación --}}
        <label for="ciudad">Ciudad</label>
        <input type="text" name="ciudad" id="ciudad" placeholder="Ciudad donde vives" required />

        <label for="ocupacion">Ocupación</label>
        <input type="text" name="ocupacion" id="ocupacion" placeholder="Tu ocupación" required />

        {{-- Datos de la mascota --}}
        <label for="tipoMascota">Tipo de mascota que deseas adoptar</label>
        <select name="tipoMascota" id="tipoMascota" required>
            <option value="">Seleccionar</option>
            <option>Perro</option>
            <option>Gato</option>
            <option>Otras</option>
        </select>

        <label for="razas">Raza</label>
        <input type="text" name="razas" id="razas" placeholder="Ejemplo: Labrador" />

        <label for="porque" class="mt-3">¿Por qué quieres adoptar?</label>
        <textarea name="porque" id="porque" rows="6" class="form-control" placeholder="Cuéntanos un poco sobre ti" required></textarea>

        {{-- Botón centrado con color verde claro y texto negro --}}
        <div
              class="text-center">
            <button class="btn" style="background-color: #90EE90; color: black; border: none; padding: 10px 20px;">Enviar solicitud</button>
        </div>
    </form>

</div>
<!-- Pie de página con contacto, centrado y con texto en azul -->
<footer style="text-align: center;">
  <div class="contacto" style="margin-top: 20px;">
    <h3 style="color: blue;">Contacto</h3>
    <p>Si tienes alguna pregunta sobre el proceso de adopción, no dudes en contactarnos:</p>
    <p>Email: petswaiting@rescatardemascotas.com</p>
    <p>Teléfono: +315467389</p>
    <p>¡Gracias por ayudar a nuestras mascotas!</p>
  </div>
</footer>

@endsection
