<!DOCTYPE HTML>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <title>Login BBB</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="{!! asset('css/style.css') !!}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;500&display=swap" rel="stylesheet">
</head>
<body class="login">
  <div class="row flex-cv">
    <div class="cuadro_login">
      <form action="{{url('login')}}" method="POST">
          @csrf
          <br>
          <h1>INICIO DE SESIÓN</h1>
          <br>
          <div class="form-group">
            <p>Usuario:</p>
            <div>
              <input class="inputlogin" type="text" name="correo_usu" placeholder="Introduce tu usuario">
            </div>
          </div>
          <br>
          <div class="form-group">
            <p>Contraseña:</p>
            <div>
              <input class="inputlogin" type="password" name="pass_usu" placeholder="Introduce la contraseña">
            </div>
          </div>
          <br><br>
          <div class="form-group">
            <button class= "botonlogin" type="submit" value="login">Iniciar Sesión</button>
          </div>
      </form>
    </div>
  </div>
</body>
</html>
