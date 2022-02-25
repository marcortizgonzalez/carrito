@if (!Session::get('correo_usu')||Session::get('rol_usu') != "usuario")
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
    <title>Camisetas Baratas</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style_principal.css">
    <script src="js/ajaxPrincipal.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<header>
    <center>
        <h1>BBB CAMISETAS DE FÚTBOL</h1>
        <h4>bueno bonito barato</h4>
    </center>
</header>

<div class="row" id="section1">
    <!--
    <div class="filtro">
        <form method="post" onsubmit="return false;">
            <input type="text" name="nombre_cami" id="nombre_cami" placeholder="Nombre..." onkeyup="filtro();return false;">
        </form>
    </div>
    -->
    <div class="one-column-s1">
        <a href="{{ url('carritoview')}}">
            @php
                if (isset($array3)){
            @endphp
                <p><b class="cesta" onclick=""><img src="../public/img/carrito.png" alt="carrito" width="25px">
            @php
                    $numbb = count($array3);
                    print_r($numbb);
                }else{
            @endphp
                    <p><b class="cesta" onclick=""><img src="../public/img/carritonull.png" alt="carrito" width="25px">
            @php
                    echo "";
                }
            @endphp</b></p>
        </a>
    </div>

    <div class="one-column-s1-l">
        <a href="{{ url('logout')}}">
            <p><b><img src="../public/img/logout.png" alt=logout" width="25px"></b></p>
        </a>
        </div>
        <div>
            <marquee behavior="scroll" direction="right" scrolldelay="1">Bienvenido @php echo Session::get('correo_usu') @endphp</marquee>
            <br>
            <br>
        </div>
</div>

<div class="row" id="camisetas">
    <div class="titulo">
        <h2>CAMISETAS MÁS POPULARES</h2>
    </div> 
    @foreach ($listaCamiseta as $camiseta)
    <div class="three-column">
        <div class="box">
            <img src="{{asset('storage').'/'.$camiseta->foto_cami}}" width="100px" height="150px" class="zoom">
            <p><b>{{$camiseta->nombre_cami}}</b></p>
            <p style="color: rgba(112, 0, 0, 0.705)"> ̶8̶9̶,̶9̶5̶€̶</p>
            <h3>{{$camiseta->precio_cami}}€</h3>
            <form action="{{url('carritoadd')}}" method="POST">
                @csrf
                <input type="hidden" name="producto_id" value="{{$camiseta->id}}">
                {{-- <div name="talla_cami" id="talla_cami">
                    <div id="radios">
                        <label for="input1">XS</label>
                        <label for="input2">S</label>
                        <label for="input3">M</label>
                        <label for="input4">L</label>
                        <label for="input5">XL</label>
                    </div>
                </div> --}}
    
                <select name="talla_cami" id="talla_cami" class="tallas">
                    <option value="M" style="text-align: center" selected disabled>TALLAS DISPONIBLES</option>
                        <option value="XS">XS</option>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                </select>
                <br>
                <br>
                <button class="añadir" id="logout" type="submit" name="Pagar" value="Pagar">Añadir al carrito</button>
            </form>
        </div>
    </div>
    @endforeach
</div>

<footer>
    <div class="row" id="footer2">
        <div class="four-column-footer">
            <h3 style="font-weight:500">Descargar aplicación móvil</h3>
            <p><img src="../public/img/applestore.png" alt="applestore" style="cursor: pointer"></p>
            <p><img src="../public/img/playstore.png" alt="googleplay" style="cursor: pointer"></p>
        </div>

        <div class="four-column-footer">
            <b>
                <p>¿Quiénes somos?</p>
                <p>Información de contacto</p>
                <p>Preguntas frecuentes</p>
            </b>

        </div>

        <div class="four-column-footer">
            <b>
                <p>Condiciones de uso</p>
                <p>Declaración de Privacidad y Cookies</p>
                <p>Aceptación de cookies</p>                
            </b>

        </div>

        <div class="four-column-footer">
            <p><img src="../public/img/instagram.png" alt="instagram" width="25px"><img src="../public/img/facebook.png" alt="facebook" width="38px" style="padding-left: 10px;"></p>
            <p>© BBB CAMISETAS DE FUTBOL - TODOS LOS DERECHOS RESERVADOS</p>
        </div>
    </div>

    <div class="row" id="footer2">
        <center>
            <div class="one-column-footer">
                <p style="text-align: center; font-size: .88rem; padding: 0px 5% 0px 5%; font-weight:100">Recuerda que la compra de camisetas de fútbol es adictiva. Compra con responsabilidad... pero COMPRA!
                </p>
            </div>
        </center>
    </div>
</footer>

</body>
</html>