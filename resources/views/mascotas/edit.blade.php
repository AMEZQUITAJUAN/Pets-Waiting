<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Mascota</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        h1 {
            text-align: center;
            color: #333333;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555555;
        }
        input, select, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #cccccc;
            border-radius: 5px;
            font-size: 14px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }
        button:hover {
            background-color: #45a049;
        }
        .error-container {
            color: red;
            border: 1px solid red;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            background-color: #ffe6e6;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #007BFF;
            text-decoration: none;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Editar Mascota</h1>

    {{-- Mostrar errores de validación --}}
    @if ($errors->any())
        <div class="error-container">
            <strong>Por favor corrige los siguientes errores:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulario para editar una mascota --}}
    <form action="{{ route('mascotas.update', $mascota->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') {{-- Método HTTP PUT para actualizar --}}
        
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $mascota->nombre) }}" required>

        <label for="especie">Especie:</label>
        <select id="especie" name="especie" required>
            <option value="perro" {{ old('especie', $mascota->especie) == 'perro' ? 'selected' : '' }}>Perro</option>
            <option value="gato" {{ old('especie', $mascota->especie) == 'gato' ? 'selected' : '' }}>Gato</option>
            <option value="otro" {{ old('especie', $mascota->especie) == 'otro' ? 'selected' : '' }}>Otro</option>
        </select>

        <label for="edad">Edad:</label>
        <input type="number" id="edad" name="edad" value="{{ old('edad', $mascota->edad) }}" min="0" required>

        <label for="usuario_id">Usuario Asociado:</label>
        <select id="usuario_id" name="usuario_id" required>
            @foreach ($usuarios as $usuario)
                <option value="{{ $usuario->id }}" {{ old('usuario_id', $mascota->usuario_id) == $usuario->id ? 'selected' : '' }}>
                    {{ $usuario->nombre }}
                </option>
            @endforeach
        </select>

        <label for="imagen">Imagen Actual:</label>
        @if ($mascota->imagen)
            <img src="{{ asset('storage/' . $mascota->imagen) }}" alt="Imagen de {{ $mascota->nombre }}" style="width: 100%; margin-bottom: 15px;">
        @else
            <p>No hay imagen disponible.</p>
        @endif

        <label for="imagen">Actualizar Imagen:</label>
        <input type="file" id="imagen" name="imagen" accept="image/*">

        <button type="submit">Actualizar Mascota</button>
    </form>

    <a href="{{ route('mascotas.index') }}" class="back-link">Volver Admin</a>
</div>
</body>
</html>

