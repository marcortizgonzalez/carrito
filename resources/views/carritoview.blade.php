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
    $suma=0;
    if (is_null($array3)){
        return redirect()->to('/principal')->send();
    }
    $numbb = count($array3);
    print_r('Total productos: '.$numbb);
    @endphp
    <a href="{{ url('principal')}}">
        <p><b><img src="../public/img/logout.png" alt="logout" width="25px"></b></p>
    </a>
    <table class="table table-striped table-bordered table-sm">
        <tr class="active">
            <th>ID</th>
            <th>Nombre Camiseta</th>
            <th>Precio</th>
            <th>Foto</th>
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
       </tr>
        <?php 
        
        $suma = $suma + $info->precio_cami; ?>
        <?php } ?>
    @endforeach
    <?php $precio = $suma;
    ?>
    <td><?php echo ('Total a pagar: '.$precio);?></td>
    <td><form action="{{url('enviarDinero/'.$precio)}}" method="GET">
        <button class= "botonAct" id="logout" type="submit" name="Pagar" value="Pagar">Pagar</button>
    </form></td>
    <td><form action="{{url('carritovaciar')}}" method="GET">
        <button class= "botonAct" id="logout" type="submit" name="Clear" value="Clear">Vaciar Carrito</button>
    </form></td>
</body>
</html>