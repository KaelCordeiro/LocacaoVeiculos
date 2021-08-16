<?php
    session_start();
    if (isset($_SESSION['perfil']) && ($_SESSION['perfil'] != "Veículo" || $_SESSION['perfil'] != "Cliente")) {
        $perfil = $_SESSION['perfil'];
    } else {
        session_destroy();
        header("location:login.php");
    }
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="css/style.css" rel="stylesheet">
        <title>Atualizar veículo</title>
    </head>
    <body class="locacao">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.php"><?php echo $perfil ?></a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="../index.php">Início</a>
                </li>
              </ul>
                <form class="d-flex" action="../acoes/acaoLogin.php">
                    <button class="btn btn-dark" name="acao" type="submit" value="logoff">Sair</button>
                </form>
          </div>
      </div>
    </nav>
        <form action="../acoes/acaoVeiculo.php" method="POST" class="col-md-12 text-center" style="margin-top: 20px">
            <h1>Alterar veículo</h1> <br/>
            <h2>Marque os campos que deseja alterar (caso não esteja marcado, não será alterado)</h2> <br/> <br/> <br/>
            <input type='hidden' name='codigoVeiculo' value='<?php echo $_POST['codigoVeiculo'] ?>'/>
            <h4>Nome do Veículo: <input type="text" name="nome"/>  <input type="checkbox" name="alterarNome"></h4> <br/>
            <h4>Marca: <input type="text" name="marca"/> <input type="checkbox" name="alterarMarca"></h4> <br/>
            <h4>Cidade: <input type="text" name="cidade"/> <input type="checkbox" name="alterarCidade"></h4> <br/>
            <h4>Estado: <input type="text" name="estado"/> <input type="checkbox" name="alterarEstado"></h4> <br/>
            <h4>Placa: <input type="text" name="placa"/> <input type="checkbox" name="alterarPlaca"></h4> <br/>
            <h4>Pneu: <input type="text" name="pneu"/> <input type="checkbox" name="alterarPneu"></h4> <br/>
            <h4>Cor: <input type="text" name="cor"/> <input type="checkbox" name="alterarCor"></h4> <br/>
            <h4>Motor: <input type="text" name="motor"/> <input type="checkbox" name="alterarMotor"></h4> <br/>
            <button type="submit" name="acao" value="alterar"><h3>Confirmar</h3></button>
        </form>
    </body>
</html>
