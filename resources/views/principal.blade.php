<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Camisetas Baratas</title>
</head>
<body>

    <table>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Foto</th>
        </tr>
        @foreach ($listaCamiseta as $camiseta)
            <tr>
                <td>{{$camiseta->id}}</td>
                <td>{{$camiseta->nombre_cami}}</td>
                <td>{{$camiseta->precio_cami}}€</td>
                <td><img src="{{asset('storage').'/'.$camiseta->foto_cami}}" width="100"></td>
                <td><form action="{{url('enviarDinero/10/'.$camiseta->id)}}" method="GET">
                    <button class= "" id="logout" type="submit" name="Pagar" value="Pagar">Pagar</button>
                </form></td>
            </tr>
        @endforeach
    </table>
</body>
</html>