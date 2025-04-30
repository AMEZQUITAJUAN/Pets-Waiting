<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalles de la Mascota</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
            color: #333;
        }
        h1 {
            color: #ccb834;
            text-align: center;
            margin-bottom: 20px;
        }
        p {
            margin-bottom: 10px;
        }
        strong {
            font-weight: bold;
        }
        a {
            display: inline-block;
            padding: 8px 15px;
            background-color: #cd7031;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        a:hover {
            background-color: #da7d2b;
        }
    </style>
</head>
<body>
    <h1>Detalles de la Mascota</h1>
    <p><strong>Nombre:</strong> {{ $mascota->nombre }}</p>
    <p><strong>Especie:</strong> {{ $mascota->especie }}</p>
    <p><strong>Edad:</strong> {{ $mascota->edad }}</p>
    <p><strong>Usuario Asociado:</strong> {{ $mascota->usuario->Nombre ?? 'Sin usuario' }}</p>

    <a href="{{ route('mascotas.index') }}">Volver a la lista de mascotas</a>
    <br></br>
    <a href="{{ route('mascotas.edit', $mascota->id) }}">Editar Mascota</a> <!-- Enlace para editar la mascota -->
    <br></br>
    <form action="{{ route('mascotas.destroy', $mascota->id) }}" method="POST" style="display:inline-block;">
        @csrf <!-- Token CSRF necesario -->
        @method('DELETE') <!-- Método DELETE para la solicitud -->
        <button type="submit" style="background-color: red; color: white; border: none; padding: 8px 15px; border-radius: 5px; cursor: pointer;">
            Eliminar
        </button>
    </form>
</body>
</html>
