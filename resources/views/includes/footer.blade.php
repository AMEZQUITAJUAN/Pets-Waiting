<div class="footer bg-light py-4 mt-5">
    <div class="container text-center">
        <h5 class="mb-4">Fundaciones Asociadas</h5>
        <div class="d-flex justify-content-center align-items-center flex-wrap gap-4">
            <!-- Fundación 1 -->
            <a href="https://www.corazongatuno.org/quienes-somos" target="_blank" rel="noopener noreferrer">
                <img src="{{ asset('img/fundacion1.png') }}" alt="Fundación 1" class="footer-logo">
            </a>
            <!-- Fundación 2 -->
            <a href="https://fundacionanimallibre.com/tequila-bulldog/" target="_blank" rel="noopener noreferrer">
                <img src="{{ asset('img/fundacion2.png') }}" alt="Fundación 2" class="footer-logo">
            </a>
            <!-- Fundación 3 -->
            <a href="https://fundacionmimejoramigo.blogspot.com/2010/10/fundacion-mi-mejor-amigo.html" target="_blank" rel="noopener noreferrer">
                <img src="{{ asset('img/fundacion3.JPG') }}" alt="Fundación 3" class="footer-logo">
            </a>
        </div>
    </div>
</div>

<style>
    .footer {
        border-top: 1px solid #ddd;
    }

    .footer-logo {
        width: 100px;
        height: auto;
        transition: transform 0.3s ease;
    }

    .footer-logo:hover {
        transform: scale(1.1);
    }
</style>

