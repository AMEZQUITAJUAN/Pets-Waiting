@extends('layouts.app')  

@section('content')  
<div class="container mt-4">  
    <div class="text-center">  
        <h1>Mascotas Perdidas</h1>  
        <p class="lead">Ayúdanos a encontrar estas mascotas</p>  
        <a href="{{ route('perdidos.create') }}" class="btn btn-primary mb-4">  
            Reportar Mascota Perdida  
        </a>  
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
                        <!-- Botón "Ver más" con color personalizado (ejemplo: verde) -->  
                        <button class="btn btn-success btn-sm mb-2" onclick="toggleDetalles(this)">  
                            Ver más  
                        </button>  
                        <!-- Sección oculta con detalles adicionales, con fondo y color propio -->  
                        <div style="display:none; padding:10px; border:1px solid #ccc; border-radius:4px; background-color:#f8f9fa; color:#333;">  
                            <p><strong>Detalles adicionales:</strong></p>  
                            <!-- Aquí puedes agregar toda la info que desees, por ejemplo: -->  
                            <p><strong>Características:</strong> Pelaje negro con manchas blancas, se parece farruko.</p>  
                            <p><strong>Contacto:</strong> Teléfono: 3142198626, Correo: alejandra123@gmail.com</p>  
                            <p><strong>Lugar exacto:</strong> Parque Central, cerca de la fuente.</p>  
                            <!-- Puedes agregar más info o imágenes -->  
                        </div>  
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

<script>  
function toggleDetalles(btn) {  
    const detalles = btn.nextElementSibling;  
    if (detalles.style.display === 'none' || detalles.style.display === '') {  
        detalles.style.display = 'block';  
        btn.textContent = 'Ver menos';  
        // Cambiar color del botón a azul  
        btn.classList.remove('btn-success', 'btn-danger');  
        btn.classList.add('btn-primary');  
    } else {  
        detalles.style.display = 'none';  
        btn.textContent = 'Ver más';  
        // Volver al color original (verde)  
        btn.classList.remove('btn-primary', 'btn-danger');  
        btn.classList.add('btn-success');  
    }  
}  
</script>  
@endsection