<?php 
  session_start();
  if (isset($_SESSION['usuario']))
  	header("location:index.php");
 ?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
    <title>Login</title>
  </head>
  <body class="login">
      <form action="acoes/acaoLogin.php" id="form" method="post" class="col-md-12 text-center" style="margin-top: 180px">
        <h1 style="color: white">Sistema de Locação de Veículos</h1> <br/> <br/> <br/> <br/>
        <fieldset>
            <legend><h2 style="color: white">Login</h2></legend>
            <label for="user"><h3 style="color: white">Usuário</h3></label>
            <input type="text" name="user" id="user" value=""><br/><br/>
            <label for="pass"><h3 style="color: white">Senha</h3></label>
            <input type="password" name="pass" id="pass" value=""><br/><br/>
            <button name="acao" value="login" id="login" type="submit" style="width: 250px">
                <h5>Entrar</h5>
            </button>
        </fieldset>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
