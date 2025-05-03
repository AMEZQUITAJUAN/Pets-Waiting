@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Dale un hogar a una <span>mascota necesitada</span></h1>
            <p>Juntos podemos salvar vidas y crear familias felices. Adopta, no compres.</p>
            <div class="hero-buttons">
                <a href="{{ route('mascotas.create') }}" class="btn btn-primary">Adopta una mascota</a>
                <a href="{{ route('mascotas.index') }}" class="btn btn-secondary">Ver todas las mascotas</a>
            </div>
        </div>
    </section>

    <!-- Mascotas Section -->
    <div class="container mt-5">
        @if ($mascotas->isEmpty())
            <p class="text-center">No hay mascotas registradas.</p>
        @else
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach ($mascotas as $mascota)
                    <div class="col">
                        <div class="card h-100">
                            <img src="{{ $mascota->imagen ?? 'https://via.placeholder.com/300x200' }}"
                                 class="card-img-top"
                                 alt="Imagen de {{ $mascota->nombre }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $mascota->nombre }}</h5>
                                <p class="card-text">
                                    <strong>Especie:</strong> {{ $mascota->especie }}<br>
                                    <strong>Edad:</strong> {{ $mascota->edad }} años<br>
                                    <strong>Cuidador:</strong> {{ $mascota->usuario->nombre ?? 'Sin cuidador' }}
                                </p>
                            </div>
                            <div class="card-footer text-center">
                                <a href="{{ route('mascotas.show', $mascota->id) }}"
                                   class="btn btn-success">Ver Detalles</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Botón Ver Más -->
            <div class="text-center mt-4">
                <a href="{{ route('adopcion') }}" class="btn btn-primary">Ver Más</a>
            </div>

            <section class="suscripcion">
    <h2>Únete a nuestra causa</h2>
    <p>Al suscribirte, aceptas recibir actualizaciones sobre nuestras mascotas y eventos. <a href="#">Términos y condiciones</a>.</p>
</section>

            <!-- Paginación -->
            <div class="d-flex justify-content-center mt-4">
                {{ $mascotas->links() }}
            </div>
        @endif
    </div>
@endsection
