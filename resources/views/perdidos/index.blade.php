@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="text-center">
        <h1>Mascotas Perdidas</h1>
        <p class="lead">Ayúdanos a encontrar estas mascotas</p>
        <form action="{{ route('perdidos.create') }}" method="GET">
            @csrf
            <button type="submit" class="btn btn-primary mb-4">
                Reportar Mascota Perdida
            </button>
        </form>
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
                            <strong>Fecha:</strong> {{ $perdido->fecha_perdida }}
                        </p>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p>No hay mascotas perdidas registradas.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
