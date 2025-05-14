@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <!-- Tabs de navegación -->




    <!-- Contenido de los tabs -->
    <div class="tab-content" id="myTabContent">
        <!-- Tab Mascotas en Adopción -->
        <div class="tab-pane fade show active" id="mascotas" role="tabpanel">
            <h2 class="text-center mb-4">Mascotas en Adopción</h2>

            @if (auth()->user()->rol === 'admin')
                <!-- Contenido para administradores -->
                
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


