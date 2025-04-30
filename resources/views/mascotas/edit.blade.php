<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Mascota</title>
</head>
<body>
    <h1>Editar Mascota</h1>

    {{-- Mostrar errores de validación --}}
    @if ($errors->any())
        <div style="color: red; border: 1px solid red; padding: 10px; margin-bottom: 20px;">
            <strong>Por favor corrige los siguientes errores:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulario para editar una mascota --}}
    <form action="{{ route('mascotas.update', $mascota->id) }}" method="POST">
        @csrf
        @method('PUT') {{-- Método HTTP PUT para actualizar --}}

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $mascota->nombre) }}" required>
        <br><br>

        <label for="especie">Especie:</label>
        <select id="especie" name="especie" required>
            <option value="perro" {{ old('especie', $mascota->especie) == 'perro' ? 'selected' : '' }}>Perro</option>
            <option value="gato" {{ old('especie', $mascota->especie) == 'gato' ? 'selected' : '' }}>Gato</option>
            <option value="otro" {{ old('especie', $mascota->especie) == 'otro' ? 'selected' : '' }}>Otro</option>
        </select>
        <br><br>

        <label for="edad">Edad:</label>
        <input type="number" id="edad" name="edad" value="{{ old('edad', $mascota->edad) }}" min="0" required>
        <br><br>

        <label for="usuario_id">Usuario Asociado:</label>
        <select id="usuario_id" name="usuario_id" required>
            @foreach ($usuarios as $usuario)
                <option value="{{ $usuario->id }}" {{ old('usuario_id', $mascota->usuario_id) == $usuario->id ? 'selected' : '' }}>
                    {{ $usuario->nombre }}
                </option>
                </option>
            @endforeach
        </select>
        <br><br>

        <button type="submit" class="btn btn-primary">Actualizar Mascota</button>
    </form>

    <a href="{{ route('mascotas.index') }}">Volver a la lista de mascotas</a>
<pre>{{ print_r($usuarios, true) }}</pre></body>
</html>
