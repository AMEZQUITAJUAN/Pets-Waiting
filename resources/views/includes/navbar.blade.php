<nav class="navbar navbar-expand-lg fixed-top" style="background-color: #f8f3e6;">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{asset('img/mascotas.png')}}" alt="Logo" class="navbar-logo">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                        Inicio
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('adopcion') ? 'active' : '' }}" href="{{ route('adopcion') }}">
                        Adopción
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('perdidos.*') ? 'active' : '' }}" href="{{ route('perdidos.index') }}">
                        Perdidos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('porquea') ? 'active' : '' }}" href="{{ route('porquea') }}">
                        ¿Por qué Adoptar?
                    </a>
                </li>

                @auth
                    @if(auth()->user()->rol === 'admin')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown">
                                Administración
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="adminDropdown">
                                <li>
                                    <a class="dropdown-item {{ Request::routeIs('usuarios_list') ? 'active' : '' }}"
                                       href="{{ route('usuarios_list') }}">
                                        <i class="fas fa-users"></i> Usuarios
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item {{ Request::routeIs('mascotas.*') ? 'active' : '' }}"
                                       href="{{ route('mascotas.index') }}">
                                        <i class="fas fa-paw"></i> Adopciones
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item {{ Request::routeIs('perdidos.*') ? 'active' : '' }}"
                                       href="{{ route('admin.perdidos') }}">
                                        <i class="fas fa-search"></i> Perdidos
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>

                            </ul>
                        </li>
                    @endif
                @endauth
            </ul>

            <div class="d-flex">
                @auth
                    <!-- Notificaciones -->
                    <div class="nav-item dropdown me-3">
                        <a class="nav-link dropdown-toggle notification-icon" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-bell"></i>
                            @php
                                $notificacionesNoLeidas = \App\Models\Notificacion::where('usuario_id', auth()->id())
                                                    ->where('leido', false)
                                                    ->count();
                            @endphp
                            @if($notificacionesNoLeidas > 0)
                                <span class="badge bg-danger rounded-pill position-absolute top-0 end-0">
                                    {{ $notificacionesNoLeidas }}
                                </span>
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" style="width: 300px; max-height: 400px; overflow-y: auto;">
                            <div class="d-flex justify-content-between align-items-center px-3 py-2 bg-light">
                                <h6 class="mb-0">Notificaciones</h6>
                                @if($notificacionesNoLeidas > 0)
                                    <form action="{{ route('notificaciones.marcar-todas') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-link p-0 text-muted">
                                            Marcar todas como leídas
                                        </button>
                                    </form>
                                @endif
                            </div>

                            <div class="dropdown-divider my-0"></div>

                            @php
                                $ultimasNotificaciones = \App\Models\Notificacion::where('usuario_id', auth()->id())
                                                    ->orderBy('created_at', 'desc')
                                                    ->limit(5)
                                                    ->get();
                            @endphp

                            @forelse($ultimasNotificaciones as $notificacion)
                                <div class="dropdown-item py-2 px-3 {{ $notificacion->leido ? '' : 'fw-bold' }}">
                                    <div class="d-flex align-items-start">
                                        @if($notificacion->tipo == 'encontrado')
                                            <div class="flex-shrink-0 me-2 mt-1">
                                                <i class="fas fa-search text-success"></i>
                                            </div>
                                        @else
                                            <div class="flex-shrink-0 me-2 mt-1">
                                                <i class="fas fa-bell"></i>
                                            </div>
                                        @endif
                                        <div class="flex-grow-1 overflow-hidden">
                                            <div style="white-space: normal;">{{ $notificacion->mensaje }}</div>
                                            <small class="text-muted">{{ $notificacion->created_at->diffForHumans() }}</small>
                                        </div>
                                    </div>



                                     
                                </div>
                            @empty
                                <div class="dropdown-item text-center py-3">
                                    <span class="text-muted">No tienes notificaciones</span>
                                </div>
                            @endforelse

                            <div class="dropdown-divider my-0"></div>
                            <a class="dropdown-item text-center py-2" href="{{ route('notificaciones.index') }}">
                                Ver todas las notificaciones
                            </a>
                        </div>
                    </div>
                    <div class="user-circle me-3">
                        {{ strtoupper(substr(auth()->user()->nombre, 0, 1)) }}
                    </div>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Cerrar Sesión</button>
                    </form>
                @else
                    <a href="{{ route('login.submit') }}" class="btn btn-primary">Iniciar Sesión</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<style>
.navbar {
    padding: 0.5rem 1rem;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    background-color: #fbfaf8 !important;
}

.navbar-logo {
    height: 50px; /* Ajusta este valor según necesites */
    width: auto;
    object-fit: contain;
}

.navbar-brand {
    padding: 0;
    margin-right: 1rem;
}

.nav-link {
    color: #2234ff            !important;
    font-weight: 500;
    padding: 0.5rem 1rem !important;
    transition: color 0.3s ease;
}

.nav-link:hover {
    color: #d81b60 !important;
}

.nav-link.active {
    color: #d81b60 !important;
}

.user-circle {
    width: 40px;
    height: 40px;
    background-color: #dd0505ef;
    color: rgb(229, 202, 121);
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-weight: bold;
    font-size: 16px;
    text-transform: uppercase;
}

.btn-danger {
    background-color: #dc3545;
    border: none;
}

.btn-danger:hover {
    background-color: #c82333;
}

.dropdown-item {
    color: #2234ff !important;
    padding: 0.5rem 1rem;
    transition: all 0.3s ease;
}

.dropdown-item:hover {
    background-color: #f8f9fa;
    color: #d81b60 !important;
}

.dropdown-item.active {
    background-color: #e9ecef;
    color: #d81b60 !important;
}

.dropdown-item i {
    width: 20px;
    text-align: center;
    margin-right: 8px;
}

.dropdown-divider {
    margin: 0.5rem 0;
    border-color: #dee2e6;
}

.dropdown-menu {
    border: none;
    box-shadow: 0 2px 15px rgba(0,0,0,0.1);
    border-radius: 8px;
    padding: 0.5rem;
}
</style>
