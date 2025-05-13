<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Mascota</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        h1 {
            text-align: center;
            color: #333333;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555555;
        }
        input, select, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #cccccc;
            border-radius: 5px;
            font-size: 14px;
        }
        button {
            background-color: #1e3aab;
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }
        button:hover {
            background-color: #0e58c6;
        }
        .error-container {
            color: red;
            border: 1px solid red;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            background-color: #ffe6e6;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #007BFF;
            text-decoration: none;
        }
        .back-link:hover {
            text-decoration: underline;
        }
        .image-preview {
            width: 100%;
            max-height: 200px;
            object-fit: contain;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .success-alert {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Editar Mascota</h1>

    @if (session('success'))
        <div class="success-alert">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="error-container">
            <strong>Por favor corrige los siguientes errores:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('mascotas.update', $mascota->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $mascota->nombre) }}" required>

        <label for="especie">Especie:</label>
        <select id="especie" name="especie" required>
            <option value="perro" {{ old('especie', $mascota->especie) == 'perro' ? 'selected' : '' }}>Perro</option>
            <option value="gato" {{ old('especie', $mascota->especie) == 'gato' ? 'selected' : '' }}>Gato</option>
            <option value="otro" {{ old('especie', $mascota->especie) == 'otro' ? 'selected' : '' }}>Otro</option>
        </select>

        <label for="edad">Edad:</label>
        <input type="number" id="edad" name="edad" value="{{ old('edad', $mascota->edad) }}" min="0" required>

        <input type="hidden" name="usuario_id" value="{{ auth()->id() }}">

        <label for="imagen">Imagen Actual:</label>
        @if ($mascota->imagen)
            <img src="{{ asset('storage/' . $mascota->imagen) }}" class="image-preview" alt="Imagen de {{ $mascota->nombre }}">
        @else
            <p>No hay imagen disponible.</p>
        @endif

        <label for="imagen">Actualizar Imagen:</label>
        <input type="file" id="imagen" name="imagen" accept="image/*">
        <small>Formatos permitidos: JPG, PNG, GIF. Tamaño máximo: 2MB</small>

        <button type="submit">Actualizar Mascota</button>
    </form>

    <a href="{{ route('adopcion') }}" class="back-link">Volver</a>
</div>

<script>
    // Vista previa de la imagen cuando se selecciona
    document.getElementById('imagen').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            const preview = document.querySelector('.image-preview') || document.createElement('img');
            if (!preview.classList.contains('image-preview')) {
                preview.classList.add('image-preview');
                document.querySelector('label[for="imagen"]').after(preview);
            }

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }

            reader.readAsDataURL(file);
        }
    });
</script>
</body>
</html>

