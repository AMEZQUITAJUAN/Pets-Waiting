<form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">

    @csrf

    <label>
        Ingrese el nombre del usuario:
        <br>
        <input type="text" name="name">
    </label>
    <br>
    <label>
        Ingrese el correo: :
        <br>
        <input type="text" name="email">
    </label>
    <br><br>
    <br>
    <label>
        Ingrese la contraseña: :
        <br>
        <input type="text" name="password">
    </label>
    <br><br>

    <button type="submit">Ingresar:</button>
    </form><form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">

        @csrf

        <label>
            Ingrese el nombre del producto:
            <br>
            <input type="text" name="name">
        </label>
        <br>
        <label>
            Ingrese el precio del producto: :
            <br>
            <input type="number" name="price">
        </label>
        <br><br>

        <button type="submit">Enviar Formulario:</button>
        </form>
