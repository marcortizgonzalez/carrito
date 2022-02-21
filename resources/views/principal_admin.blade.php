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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>ADMIN Camisetas</title>
    <link rel="stylesheet" href="{!! asset('css/style.css') !!}">
</head>
<body class="mostrar">    
    <center>
        <h1>ADMINISTRADOR</h1>
    </center>
    <div>
        <form action="{{url('logout')}}" method="GET">
            <button id="logout" class= "botonCre" type="submit" name="logout" value="logout">Logout</button>
        </form>
    </div>
    <div>
        <form action="{{url('crear')}}" method="GET">
            <button class= "botonCre" type="submit" name="Crear" value="Crear">Crear</button>
        </form>
    </div>

    <div class="row flex-cv">
        <table class="table">
            <tr class="active">
                <th>ID</th>
                <th>NOMBRE</th>
                <th>PRECIO</th>
                <th>FOTO</th>
                <th>ELIMINAR</th>
            </tr>
            @foreach($listaCamiseta as $camiseta)
                <tr>
                    <td>{{$camiseta->id}}</td>
                    <td>{{$camiseta->nombre_cami}}</td>
                    <td>{{$camiseta->precio_cami}}€</td>
                    <td style="padding: auto; text-align: center"><img src="{{asset('storage').'/'.$camiseta->foto_cami}}" width="100"></td>
                    <td><form action="{{url('eliminarCamiseta/'.$camiseta->id)}}" method="POST">
                        @csrf
                        <!--{{csrf_field()}}--->
                        {{method_field('DELETE')}}
                        <!--@method('DELETE')--->
                        <button class= "botonEli" type="submit" name="Eliminar" value="Eliminar">Eliminar</button>
                    </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</body>
</html>