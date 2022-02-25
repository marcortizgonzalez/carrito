@if (!Session::get('correo_usu')||Session::get('rol_usu') != "admin")
    <?php
        //Si la session no esta definida te redirige al login, la session se crea en el método.
        return redirect()->to('/')->send();
    ?>
@endif
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CREAR</title>
</head>
<body>

    <form action="{{url('crear-proc')}}" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
        <!--@csrf-->
        {{method_field('POST')}}
        <p><b>Nombre</b></p>
        <input type="text" name="nombre_cami" id="nombre_cami" placeholder="Introduce el nombre..." value="{{old('nombre_cami')}}">
        <br>
        <p><b>Precio</b></p>
        <input type="number" step="any" name="precio_cami" id="precio_cami" placeholder="Introduce el precio...">
        <br>
        <p><b>Imagen</b></p>
        <input type="file" name="foto_cami" id="foto_cami">
        <br>
        <br>
        <div>
            <input type="submit" value="Enviar">
        </div>
    </form>
</body>
</html>