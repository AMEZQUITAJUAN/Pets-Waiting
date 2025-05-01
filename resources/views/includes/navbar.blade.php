<nav class="navbar navbar-expand-lg fixed-top" style="background-color: #f8f3e6; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
    <div class="container-fluid">
        <!-- Logo con temática de mascotas -->
        <a class="navbar-brand" href="#" style="color: #5a3e2b; font-weight: bold;">
            🐾 Rescate de Mascotas
        </a>
        <!-- Botón para dispositivos móviles -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Enlaces de navegación -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('home')}}" style="color: #5a3e2b;">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('mascotas.index')}}" style="color: #5a3e2b;">Adopción</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" style="color: #5a3e2b;">Perdidos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" style="color: #5a3e2b;">Contacto</a>
                </li>
            </ul>
            <!-- Barra de búsqueda -->
            <form class="d-flex me-3">
                <input class="form-control" type="search" placeholder="Buscar" aria-label="Search" style="border-radius: 20px;">
            </form>
            <!-- Botón destacado -->
            <a href="#" class="btn" style="background-color: #ff5722; color: white; border-radius: 20px; padding: 0.5rem 1rem;">
                Adoptar ahora
            </a>
        </div>
    </div>
</nav>
