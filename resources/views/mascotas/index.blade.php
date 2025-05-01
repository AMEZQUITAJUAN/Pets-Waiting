@extends('layouts.app')

@section('content')
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
</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Mascotas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Lista de Mascotas</h1>
        <a href="{{ route('mascotas.create') }}" class="btn btn-primary mb-4">Registrar una nueva mascota</a>

        @if ($mascotas->isEmpty())
            <p class="text-center">No hay mascotas registradas.</p>
        @else
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach ($mascotas as $mascota)
                    <div class="col">
                        <div class="card h-100">
                            <img src="{{ $mascota->imagen ? asset('storage/' . $mascota->imagen) : 'https://via.placeholder.com/300x200' }}" class="card-img-top" alt="Imagen de {{ $mascota->nombre }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $mascota->nombre }}</h5>
                                <p class="card-text"><strong>Especie:</strong> {{ $mascota->especie }}</p>
                                <p class="card-text"><strong>Edad:</strong> {{ $mascota->edad }} años</p>
                                <p class="card-text"><strong>Usuario Asociado:</strong> {{ $mascota->usuario->nombre ?? 'Sin usuario' }}</p>
                            </div>
                            <div class="card-footer text-center">
                                <a href="{{ route('mascotas.show', $mascota->id) }}" class="btn btn-success">Ver Detalles</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection
