<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @php
    $numbb = count($array3);
    print_r('Total productos: '.$numbb);
    @endphp
    <a href="{{ url('principal')}}">
        <p><b><img src="../public/img/logout.png" alt=logout" width="25px"></b></p>
    </a>
    <table class="table table-striped table-bordered table-sm">
        <tr class="active">
            <th>ID</th>
            <th>Nombre Camiseta</th>
            <th>Precio</th>
            <th>Foto</th>
            <th>Eliminar del carrito</th>
        </tr>
    @foreach ($array3 as $datosprod)
    <?php
       $listainfo = DB::table('camisetas')->select('*')->where('id','=',$datosprod)->get();
       foreach ($listainfo as $info){
        ?>
        <tr>
       <td><?php echo $info->id;?></td>
       <td><?php echo $info->nombre_cami;?></td>
       <td><?php echo $info->precio_cami;?></td>
       <td><img src="{{asset('storage').'/'.$info->foto_cami}}" width="100"></td>
       <td>
        <button class= "" type="submit" name="Eliminar" value="Eliminar">Eliminar</button>
        </td>
        </tr>
    

        <?php } ?>
    @endforeach
</body>
</html>