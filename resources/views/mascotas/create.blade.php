@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Mascota</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
            color: #333;
        }
        h1 {
            color: #c5c034;
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 50%;
            margin: 0 auto;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"],
        input[type="file"],
        select {
            width: calc(100% - 12px);
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        select option:first-child {
            color: #999;
        }
        button[type="submit"] {
            background-color: #5cb85c;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button[type="submit"]:hover {
            background-color: #4cae4c;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 8px 15px;
            background-color: #d77c22;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        a:hover {
            background-color: #d77c22;
        }
        div[style="color: red;"] {
            background-color: #ffe0e0;
            color: #d9534f;
            padding: 10px;
            border: 1px solid #d9534f;
            border-radius: 4px;
            margin-bottom: 10px;
        }
        div[style="color: red;"] ul {
            margin-top: 5px;
            margin-bottom: 0;
            padding-left: 20px;
        }
    </style>
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
    <form action="{{ route('mascotas.store') }}" method="POST" enctype="multipart/form-data">
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
                    {{ $usuario->nombre }}
                </option>
            @endforeach
        </select>
        <br><br>

        <label for="imagen">Imagen:</label>
        <input type="file" id="imagen" name="imagen" accept="image/*">
        <br><br>

        <button type="submit">Registrar Mascota</button>
    </form>

    <a href="{{ route('mascotas.index') }}">Volver a la lista de mascotas</a>
</body>
</html>
@endsection
