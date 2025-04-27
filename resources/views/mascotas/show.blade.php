<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalles de la Mascota</title>
</head>
<body>
    <h1>Detalles de la Mascota</h1>
    <p><strong>Nombre:</strong> {{ $mascota->nombre }}</p>
    <p><strong>Especie:</strong> {{ $mascota->especie }}</p>
    <p><strong>Edad:</strong> {{ $mascota->edad }}</p>
    <p><strong>Usuario Asociado:</strong> {{ $mascota->usuario->Nombre ?? 'Sin usuario' }}</p>

    <a href="{{ route('mascotas.index') }}">Volver a la lista de mascotas</a>
</body>
</html>