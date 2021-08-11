<?php 
  session_start();
  if (isset($_SESSION['usuario']))
  	header("location:index.php");
 ?>
<html>
<head>
  <meta charset="utf-8">
  <title>LocacaoVeiculos - Login</title>
</head>
<body>

<form action="acaoLogin.php" id="form" method="post">
  <fieldset>
    <legend>Autenticação</legend>
    <label for="user">Usuário</label>
    <input type="text" name="user" id="user" value=""><br/><br/>
    <label for="pass">Senha</label>
    <input type="password" name="pass" id="pass" value=""><br/><br/>
    <button name="acao" value="login" id="login" type="submit">
      Entrar
    </button>
  </fieldset>
</form>
</body>
</html>
