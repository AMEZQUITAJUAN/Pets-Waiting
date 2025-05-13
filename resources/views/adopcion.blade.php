@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <!-- Hero Section -->
    <div class="hero-section">
        <h1>ADOPCIÓN DE PERROS Y GATOS</h1>
        <p>Busca por las características de la mascota que deseas adoptar.</p>
        @auth
            <a href="{{ route('mascotas.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Publicar una mascota
            </a>
        @else
            <a href="{{ route('login') }}" class="btn btn-primary">
                <i class="fas fa-sign-in-alt"></i> Inicia sesión para publicar
            </a>
        @endauth
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Lista de Mascotas simplificada -->
    <div class="row">
        @forelse($mascotas as $mascota)
            <div class="col-md-4 mb-4">
                <div class="card mascota-card">
                    <!-- Solo una imagen con fondo blanco -->
                    <div class="img-container" style="background-color: white; padding: 10px;">
                        @if($mascota->imagen)
                            <img src="{{ asset('storage/' . $mascota->imagen) }}"
                                class="card-img-top mascota-imagen"
                                alt="Foto de {{ $mascota->nombre }}">
                        @else
                            <img src="{{ asset('img/no-image.jpg') }}"
                                class="card-img-top mascota-imagen"
                                alt="Sin imagen">
                        @endif
                    </div>

                    <!-- Banner con nombre -->
                    <div class="mascota-nombre-banner">
                        <h5 class="mb-0">{{ $mascota->nombre }}</h5>
                    </div>

                    <div class="card-body">
                        <p class="card-text">
                            <strong>Especie:</strong> {{ ucfirst($mascota->especie) }}<br>
                            <strong>Edad:</strong> {{ $mascota->edad }} {{ $mascota->edad == 1 ? 'año' : 'años' }}
                        </p>

                        <div class="botones-accion text-center">
                            <a href="{{ route('mascotas.show', $mascota->id) }}" class="btn btn-primary">
                                Ver Detalles
                            </a>

                            @auth
                                @if(auth()->user()->id === $mascota->usuario_id || auth()->user()->rol === 'admin')
                                    <div class="mt-2">
                                        <a href="{{ route('mascotas.edit', $mascota->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Editar
                                        </a>
                                        <form action="{{ route('mascotas.destroy', $mascota->id) }}"
                                            method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('¿Estás seguro de eliminar esta mascota?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i> Eliminar
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <div class="alert alert-info">
                    No hay mascotas disponibles para adopción en este momento.
                </div>
            </div>
        @endforelse
    </div>
</div>

<style>
    /* Estilos simplificados */
    .hero-section {
        background-image: url('img/newpatas.jpg');
        background-size: cover;
        background-position: center;
        height: 50vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        color: #fff;
        padding: 30px;
        margin-bottom: 30px;
        border-radius: 10px;
    }

    .mascota-card {
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        border-radius: 8px;
        overflow: hidden;
        background-color: white;
    }

    .mascota-imagen {
        width: 100%;
        height: 250px;
        object-fit: cover;
        border: none;
    }

    .mascota-nombre-banner {
        background-color: #343a40;
        color: white;
        padding: 10px;
        text-align: center;
    }

    .botones-accion {
        margin-top: 15px;
    }
</style>
@endsection
