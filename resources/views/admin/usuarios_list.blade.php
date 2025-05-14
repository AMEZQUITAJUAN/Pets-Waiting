@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h2 class="text-center mb-4">Gestión de Usuarios</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Mascotas Registradas</th>
                    <th>Mascotas Perdidas</th>
                    <th>Fecha Registro</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->id }}</td>
                        <td>{{ $usuario->name }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>
                            <span class="badge {{ $usuario->rol === 'admin' ? 'bg-danger' : 'bg-primary' }}">
                                {{ $usuario->rol }}
                            </span>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#mascotasModal{{ $usuario->id }}">
                                Ver ({{ $usuario->mascotas->count() }})
                            </button>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#perdidosModal{{ $usuario->id }}">
                                Ver ({{ $usuario->perdidos->count() }})
                            </button>
                        </td>
                        <td>{{ $usuario->created_at->format('d/m/Y') }}</td>
                        <td>
                            @if($usuario->rol !== 'admin')
                                <form action="{{ route('admin.usuarios.destroy', $usuario->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Eliminar
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>

                    <!-- Modal Mascotas -->
                    <div class="modal fade" id="mascotasModal{{ $usuario->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Mascotas de {{ $usuario->name }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    @if($usuario->mascotas->isEmpty())
                                        <p class="text-center">No hay mascotas registradas</p>
                                    @else
                                        <ul class="list-group">
                                            @foreach($usuario->mascotas as $mascota)
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    {{ $mascota->nombre }}
                                                    <span class="badge bg-primary rounded-pill">{{ $mascota->especie }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Perdidos -->
                    <div class="modal fade" id="perdidosModal{{ $usuario->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Mascotas Perdidas de {{ $usuario->name }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    @if($usuario->perdidos->isEmpty())
                                        <p class="text-center">No hay mascotas perdidas registradas</p>
                                    @else
                                        <ul class="list-group">
                                            @foreach($usuario->perdidos as $perdido)
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    {{ $perdido->nombre }}
                                                    <span class="badge bg-{{ $perdido->estado === 'encontrado' ? 'success' : 'danger' }} rounded-pill">
                                                        {{ $perdido->estado }}
                                                    </span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@section('styles')
<style>
    .table {
        width: 100%;
    }
    .table th, .table td {
        padding: 12px;
        vertical-align: middle;
    }
    .badge {
        font-size: 0.9em;
        padding: 6px 10px;
    }
    .btn-sm {
        padding: 5px 10px;
    }
    .container-fluid {
        padding: 20px;
    }
    .modal-dialog {
        max-width: 500px;
    }
    .list-group-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
</style>
@endsection
