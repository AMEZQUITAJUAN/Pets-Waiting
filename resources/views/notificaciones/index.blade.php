<!-- resources/views/notificaciones/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">Mis Notificaciones</h3>

                    @if($notificaciones->where('leido', false)->count() > 0)
                    <form action="{{ route('notificaciones.marcar-todas') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-light btn-sm">
                            <i class="fas fa-check-double me-2"></i>Marcar todas como leídas
                        </button>
                    </form>
                    @endif
                </div>

                <div class="card-body p-0">
                    @if(session('success'))
                        <div class="alert alert-success m-3">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($notificaciones->isEmpty())
                        <div class="text-center p-5">
                            <i class="fas fa-bell-slash fa-3x text-muted mb-3"></i>
                            <p class="lead">No tienes notificaciones por el momento.</p>
                        </div>
                    @else
                        <div class="list-group list-group-flush">
                            @foreach($notificaciones as $notificacion)
                                <div class="list-group-item p-3 {{ $notificacion->leido ? 'bg-light' : 'bg-success bg-opacity-10' }}">
                                    <div class="d-flex w-100 justify-content-between align-items-center">
                                        <h5 class="mb-1">
                                            @if(!$notificacion->leido)
                                                <span class="badge bg-success me-2">Nueva</span>
                                            @endif

                                            @if($notificacion->tipo == 'encontrado')
                                                <i class="fas fa-search text-success me-2"></i>Mascota Encontrada
                                            @elseif($notificacion->tipo == 'adopcion')
                                                <i class="fas fa-heart text-danger me-2"></i>Solicitud de Adopción
                                            @else
                                                <i class="fas fa-bell me-2"></i>Notificación
                                            @endif
                                            <small class="text-muted ms-2">{{ $notificacion->created_at->diffForHumans() }}</small>
                                        </h5>
                                    </div>

                                    <div class="p-2 my-2 bg-light rounded" style="white-space: pre-line;">
                                        {{ $notificacion->mensaje }}
                                    </div>

                                    <div class="d-flex justify-content-end mt-2">
                                        @if(!$notificacion->leido)
                                            <form action="{{ route('notificaciones.marcar-leida', $notificacion->id) }}" method="POST" class="me-2">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-success">
                                                    <i class="fas fa-check me-1"></i>Marcar como leída
                                                </button>
                                            </form>
                                        @endif

                                        @if($notificacion->url)
                                            <a href="{{ route('home') }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-home me-1"></i>Volver al inicio
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $notificaciones->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
