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

<div class="container mt-5">
    <h1 class="text-center mb-4">Lista de Adopciones</h1>
    <a href="{{ route('mascotas.create') }}" class="btn btn-primary mb-4">Registrar una nueva mascota</a>

    @if ($mascotas->isEmpty())
        <p class="text-center">No hay mascotas registradas.</p>
    @else
        <table class="table table-striped">
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
                        <td>{{ $mascota->edad }} años</td>
                        <td>{{ $mascota->usuario->nombre ?? 'Sin usuario' }}</td>
                        <td>
                            <a href="{{ route('mascotas.show', $mascota->id) }}" class="btn btn-success btn-sm">Ver</a>
                            <a href="{{ route('mascotas.edit', $mascota->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('mascotas.destroy', $mascota->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Paginación -->
        <div class="d-flex justify-content-center mt-4">
            {{ $mascotas->links() }}
        </div>
    @endif
</div>
@endsection
