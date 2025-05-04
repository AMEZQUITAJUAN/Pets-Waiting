@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Mascotas en Adopción</h2>
    <div class="row">
        @forelse($mascotas as $mascota)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <!-- Card content -->
                </div>
            </div>
        @empty
            <p>No hay mascotas disponibles para adopción.</p>
        @endforelse
    </div>
</div>
@endsection
