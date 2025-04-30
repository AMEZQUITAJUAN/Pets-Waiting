<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios y Mascotas</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
</head>
<body>
    <h1>Usuarios Registrados</h1>

    <a href="{{ route('usuarios.create') }}">Registrar un nuevo usuario</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->id }}</td>
                    <td>{{ $usuario->nombre }}</td>
                    <td>{{ $usuario->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $usuarios->links() }}

    <h1>Lista de Mascotas</h1>

    <a href="{{ route('mascotas.create') }}">Registrar una nueva mascota</a>

    @if ($mascotas->isEmpty())
        <p>No hay mascotas registradas.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Especie</th>
                    <th>Edad</th>
                    <th>Usuario Asociado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mascotas as $mascota)
                    <tr>
                        <td>{{ $mascota->id }}</td>
                        <td>{{ $mascota->nombre }}</td>
                        <td>{{ $mascota->especie }}</td>
                        <td>{{ $mascota->edad }}</td>
                        <td>{{ $mascota->usuario->nombre ?? 'Sin usuario' }}</td>
                        <td>
                            <a href="{{ route('mascotas.show', $mascota->id) }}" style="background-color: #4CAF50; color: white; padding: 5px 10px; text-decoration: none; border-radius: 5px;">
                                Ver Mascota
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>
</html>
