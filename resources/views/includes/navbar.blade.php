<nav class="navbar navbar-expand-lg fixed-top" style="background-color: #f8f3e6;">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">
            🐾 Rescate de Mascotas
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
            </ul>

            <div class="d-flex">
                @auth
                    <div class="user-circle me-3">
                        {{ strtoupper(substr(auth()->user()->nombre, 0, 1)) }}
                    </div>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Cerrar Sesión</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary">Iniciar Sesión</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<style>
.user-circle {
    width: 40px;
    height: 40px;
    background-color: #007bff;
    color: white;
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
</style>
