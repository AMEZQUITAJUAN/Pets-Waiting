<div class="footer bg-light py-4 mt-5">
    <div class="container text-center">
        <h5 class="mb-4">Fundaciones Asociadas</h5>
        <div class="d-flex justify-content-center align-items-center flex-wrap gap-4">
            <!-- Fundación 1 -->
            <a href="https://www.fundacion1.com" target="_blank" rel="noopener noreferrer">
                <img src="{{ asset('images/fundacion1-logo.png') }}" alt="Fundación 1" class="footer-logo">
            </a>
            <!-- Fundación 2 -->
            <a href="https://www.fundacion2.com" target="_blank" rel="noopener noreferrer">
                <img src="{{ asset('images/fundacion2-logo.png') }}" alt="Fundación 2" class="footer-logo">
            </a>
            <!-- Fundación 3 -->
            <a href="https://www.fundacion3.com" target="_blank" rel="noopener noreferrer">
                <img src="{{ asset('images/fundacion3-logo.png') }}" alt="Fundación 3" class="footer-logo">
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

