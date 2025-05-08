<nav class="navbar navbar-expand-lg fixed-top" style="background-color: #f8f3e6;">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="img/mascotas.png" alt="Logo" class="navbar-logo">
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
</style>
