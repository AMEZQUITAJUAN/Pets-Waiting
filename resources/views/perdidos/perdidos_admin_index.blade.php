@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">

    </ul>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Mascotas Perdidas</h2>
        
    </div>

    @if($perdidos->isEmpty())
        <div class="alert alert-info text-center">
            <i class="fas fa-info-circle"></i> No hay mascotas perdidas registradas.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Especie</th>
                        <th>Ubicación</th>
                        <th>Estado</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($perdidos as $perdido)
                        <tr>
                            <td>{{ $perdido->id }}</td>
                            <td>{{ $perdido->nombre }}</td>
                            <td>{{ $perdido->especie }}</td>
                            <td>{{ $perdido->ubicacion }}</td>
                            <td>
                                <span class="badge bg-{{ $perdido->estado === 'encontrado' ? 'success' : 'danger' }}">
                                    {{ $perdido->estado }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('perdidos.show', $perdido->id) }}"
                                       class="btn btn-info btn-sm"
                                       title="Ver detalles">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('perdidos.edit', $perdido->id) }}"
                                       class="btn btn-warning btn-sm"
                                       title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('perdidos.destroy', $perdido->id) }}"
                                          method="POST"
                                          style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('¿Estás seguro de eliminar este registro?')"
                                                title="Eliminar">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $perdidos->links() }}
        </div>
    @endif
</div>

@section('styles')
<style>
    .table td {
        vertical-align: middle;
    }
    .btn-group .btn {
        margin: 0 2px;
    }
    .badge {
        font-size: 0.875rem;
        padding: 0.375rem 0.75rem;
    }
</style>
@endsection
@endsection
