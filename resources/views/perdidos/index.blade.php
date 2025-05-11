@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="text-center">
        <h1>Mascotas Perdidas</h1>
        <p class="lead">Ayúdanos a encontrar estas mascotas</p>

        @auth
            <a href="{{ route('perdidos.create') }}"
               class="btn btn-primary btn-lg rounded-pill px-4 py-2"
               style="background-color: #0D6EFD; border: none; font-weight: 500;">
                Reportar Mascota Perdida
            </a>
        @else
            <div class="alert alert-info border-0" style="background: transparent;">
                <a href="{{ route('login') }}"
                   class="btn btn-primary btn-lg rounded-pill px-4 py-2"
                   style="background-color: #0D6EFD; border: none; font-weight: 500;">
                    Reportar Mascota Perdida
                </a>
            </div>
        @endauth
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @forelse($perdidos as $perdido)
            <div class="col">
                <div class="card h-100">
                    @if($perdido->imagen)
                        <img src="{{ asset('storage/' . $perdido->imagen) }}"
                             class="card-img-top"
                             alt="Foto de {{ $perdido->nombre }}"
                             style="height: 200px; object-fit: cover;">
                    @else
                        <img src="{{ asset('img/no-image.jpg') }}"
                             class="card-img-top"
                             alt="Sin imagen"
                             style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $perdido->nombre }}</h5>
                        <p class="card-text">
                            <strong>Especie:</strong> {{ ucfirst($perdido->especie) }}<br>
                            <strong>Ubicación:</strong> {{ $perdido->ubicacion }}<br>
                            <strong>Fecha:</strong> {{ \Carbon\Carbon::parse($perdido->fecha_perdida)->format('d/m/Y') }}
                        </p>
                        <a href="{{ route('perdidos.show', $perdido->id) }}" class="btn btn-primary">Ver Detalles</a>

                        @auth
                            @if(auth()->user()->id === $perdido->usuario_id || auth()->user()->rol === 'admin')
                                <a href="{{ route('perdidos.edit', $perdido->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                <form action="{{ route('perdidos.destroy', $perdido->id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('¿Estás seguro de eliminar este registro?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Eliminar
                                    </button>
                                </form>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p>No hay mascotas perdidas registradas.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $perdidos->links() }}
    </div>
</div>
@endsection
