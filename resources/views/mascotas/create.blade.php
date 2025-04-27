<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Mascota</title>
</head>
<body>
    <h1>Registrar una Nueva Mascota</h1>

    {{-- Mostrar errores de validación --}}
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulario para crear una mascota --}}
    <form action="{{ route('mascotas.store') }}" method="POST">
        @csrf {{-- Token de seguridad para formularios en Laravel --}}
        
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
        <br><br>

        <label for="especie">Especie:</label>
        <select id="especie" name="especie" required>
            <option value="">Seleccione una especie</option>
            <option value="perro" {{ old('especie') == 'perro' ? 'selected' : '' }}>Perro</option>
            <option value="gato" {{ old('especie') == 'gato' ? 'selected' : '' }}>Gato</option>
            <option value="otro" {{ old('especie') == 'otro' ? 'selected' : '' }}>Otro</option>
        </select>
        <br><br>

        <label for="edad">Edad:</label>
        <input type="number" id="edad" name="edad" value="{{ old('edad') }}" min="0" required>
        <br><br>

        <label for="usuario_id">Usuario Asociado:</label>
        <select id="usuario_id" name="usuario_id" required>
            <option value="">Seleccione un usuario</option>
            @foreach ($usuarios as $usuario)
                <option value="{{ $usuario->id }}" {{ old('usuario_id') == $usuario->id ? 'selected' : '' }}>
                    {{ $usuario->Nombre }}
                </option>
            @endforeach
        </select>
        <br><br>

        <button type="submit">Registrar Mascota</button>
    </form>

    <a href="{{ route('mascotas.index') }}">Volver a la lista de mascotas</a>
</body>
</html>