<div class="footer bg-light py-4 mt-5">  
    <div class="container text-center">  
        <h5 class="mb-4">Fundaciones Asociadas</h5>  
        <div class="d-flex justify-content-center align-items-center flex-wrap gap-4">  
            <!-- Fundación 1 -->  
            <a href="https://www.corazongatuno.org/quienes-somos" target="_blank" rel="noopener noreferrer" class="fundacion-logo-container">  
                <img src="{{ asset('img/fundacion1.png') }}" alt="Fundación 1" class="fundacion-logo">  
            </a>  
            <!-- Fundación 2 -->  
            <a href="https://fundacionanimallibre.com/tequila-bulldog/" target="_blank" rel="noopener noreferrer" class="fundacion-logo-container">  
                <img src="{{ asset('img/fundacion2.png') }}" alt="Fundación 2" class="fundacion-logo">  
            </a>  
            <!-- Fundación 3 -->  
            <a href="https://fundacionmimejoramigo.blogspot.com/2010/10/fundacion-mi-mejor-amigo.html" target="_blank" rel="noopener noreferrer" class="fundacion-logo-container">  
                <img src="{{ asset('img/fundacion3.JPG') }}" alt="Fundación 3" class="fundacion-logo">  
            </a>  
        </div>  
    </div>  
</div>  

<style>  
    .footer {  
        border-top: 1px solid #ddd;  
    }  

    /* Estilo para los logos en círculo con borde rosado */  
    .fundacion-logo-container {  
        width: 210px;  
        height: 210px;  
        display: flex;  
        justify-content: center;  
        align-items: center;  
        border-radius: 50%;  
        background-color: #fff;  
        border: 10px solid #d81b60; /* color rosado similar a la imagen */  
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);  
        transition: transform 0.3s, box-shadow 0.3s;  
        overflow: hidden;  
    }  

    /* Logo ajustado para adoptarse al contenedor circular */  
    .fundacion-logo {  
        width: 80%;  
        height: auto;  
        border-radius: 50%;  
        object-fit: contain;  
        transition: transform 0.3s;  
    }  

    /* Efecto hover en todo el contenedor */  
    .fundacion-logo-container:hover {  
        transform: scale(1.1);  
        box-shadow: 0 8px 16px rgba(0,0,0,0.2);  
    }  
</style>