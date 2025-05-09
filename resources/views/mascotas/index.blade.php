@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <!-- Tabs de navegación -->
    <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="mascotas-tab" data-bs-toggle="tab" data-bs-target="#mascotas" type="button" role="tab">
                Mascotas en Adopción
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="perdidos-tab" data-bs-toggle="tab" data-bs-target="#perdidos" type="button" role="tab">
                Mascotas Perdidas
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="adopciones-tab" data-bs-toggle="tab" data-bs-target="#adopciones" type="button" role="tab">
                Solicitudes de Adopción
            </button>
        </li>
    </ul>

    <!-- Contenido de los tabs -->
    <div class="tab-content" id="myTabContent">
        <!-- Tab Mascotas en Adopción -->
        <div class="tab-pane fade show active" id="mascotas" role="tabpanel">
            <h2 class="text-center mb-4">Mascotas en Adopción</h2>

            @if (auth()->user()->rol === 'admin')
                <!-- Contenido para administradores -->
                <a href="{{ route('mascotas.create') }}" class="btn btn-primary mb-4">Registrar Nueva Mascota</a>
            @else
                <p class="text-center text-danger">No tienes permiso para ver esta página.</p>
            @endif

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
                            <th>Estado</th>
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
                                <td>{{ $mascota->estado }}</td>
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
            @endif
        </div>

        <!-- Tab Mascotas Perdidas -->
        <div class="tab-pane fade" id="perdidos" role="tabpanel">
            <h2 class="text-center mb-4">Mascotas Perdidas</h2>
            <a href="{{ route('perdidos.create') }}" class="btn btn-primary mb-4">Reportar Mascota Perdida</a>

            @if ($perdidos->isEmpty())
                <p class="text-center">No hay mascotas perdidas registradas.</p>
            @else
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Mascota</th>
                            <th>Ubicación</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($perdidos as $perdido)
                            <tr>
                                <td>{{ $perdido->fecha_perdida }}</td>
                                <td>{{ $perdido->nombre_mascota }}</td>
                                <td>{{ $perdido->ubicacion }}</td>
                                <td>{{ $perdido->estado }}</td>
                                <td>
                                    <a href="{{ route('perdidos.show', $perdido->id) }}" class="btn btn-info btn-sm">Detalles</a>
                                    <a href="{{ route('perdidos.edit', $perdido->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        <!-- Tab Solicitudes de Adopción -->
        <div class="tab-pane fade" id="adopciones" role="tabpanel">
            <h2 class="text-center mb-4">Solicitudes de Adopción</h2>

            @if ($adopciones->isEmpty())
                <p class="text-center">No hay solicitudes de adopción.</p>
            @else
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Solicitante</th>
                            <th>Mascota</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($adopciones as $adopcion)
                            <tr>
                                <td>{{ $adopcion->created_at->format('d/m/Y') }}</td>
                                <td>{{ $adopcion->nombre }}</td>
                                <td>{{ $adopcion->mascota->nombre }}</td>
                                <td>{{ $adopcion->estado }}</td>
                                <td>
                                    
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <!-- Paginación -->
    <div class="d-flex justify-content-center mt-4">
        {{ $mascotas->links() }}
    </div>
</div>
@endsection
