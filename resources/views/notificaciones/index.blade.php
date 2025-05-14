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
                                <div class="list-group-item list-group-item-action p-3 {{ $notificacion->leido ? 'bg-light' : 'bg-success bg-opacity-10' }}">
                                    <div class="d-flex w-100 justify-content-between align-items-center">
                                        <h5 class="mb-1">
                                            @if(!$notificacion->leido)
                                                <span class="badge bg-success me-2">Nueva</span>
                                            @endif

                                            @if($notificacion->tipo == 'encontrado')
                                                <i class="fas fa-search text-success me-2"></i>Mascota Encontrada
                                            @else
                                                <i class="fas fa-bell me-2"></i>Notificación
                                            @endif
                                        </h5>
                                        <small class="text-muted">{{ $notificacion->created_at->diffForHumans() }}</small>
                                    </div>

                                    <p class="mb-2">{{ $notificacion->mensaje }}</p>

                                    <div class="d-flex justify-content-end">
                                        @if(!$notificacion->leido)
                                            <form action="{{ route('notificaciones.marcar-leida', $notificacion->id) }}" method="POST" class="me-2">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-success">
                                                    <i class="fas fa-check me-1"></i>Marcar como leída
                                                </button>
                                            </form>
                                        @endif

                                        @if($notificacion->url)
                                            <form action="{{ route('notificaciones.marcar-leida', $notificacion->id) }}" method="POST" class="me-2">
                                                @csrf
                                                <input type="hidden" name="redirect_url" value="{{ $notificacion->url }}">
                                                <button type="submit" class="btn btn-sm btn-primary">
                                                    <i class="fas fa-eye me-1"></i>Ver detalles
                                                </button>
                                            </form>
                                        @endif

                                        <form action="{{ route('notificaciones.eliminar', $notificacion->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('¿Estás seguro de eliminar esta notificación?')">
                                                <i class="fas fa-trash me-1"></i>Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="d-flex justify-content-center p-3">
                            {{ $notificaciones->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
