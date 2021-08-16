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
        <title>Atualizar locação</title>
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
        <form action="../acoes/acaoLocacao.php" method="POST" class="col-md-12 text-center" style="margin-top: 20px">
            <h1>Alterar locação</h1> <br/>
            <h2>Marque os campos que deseja alterar (caso não esteja marcado, não será alterado)</h2> <br/> <br/> <br/>
            <input type='hidden' name='codigoLocacao' value='<?php echo $_POST['codigoLocacao'] ?>'/>
            <h4>Nome do Cliente: <input type="text" name="nomeCliente"/>  <input type="checkbox" name="alterarNomeCliente"></h4> <br/>
            <h4>Nome do Veículo: <input type="text" name="nomeVeiculo"/>  <input type="checkbox" name="alterarNomeVeiculo"></h4> <br/>
            <h4>Data da Locação: <input type="datetime-local" name="data"/>  <input type="checkbox" name="alterarData"></h4> <br/>
            <h4>Dias: <input type="number" name="dias"/> <input type="checkbox" name="alterarDias"></h4> <br/>
            <h4>Devolvido: <input type="radio" name="devolvido" value="1"/>Sim   <input type="radio" name="devolvido" value="0"/>Não   <input type="checkbox" name="alterarDevolvido"></h4> <br/>
            <h4>Combustivel: <input type="number" name="combustivel"/> <input type="checkbox" name="alterarCombustivel"></h4> <br/>
            <h4>Preço: <input type="number" name="preco"/> <input type="checkbox" name="alterarPreco"></h4> <br/>
            <h4>Opcao: <input type="radio" name="opcao" value="1"/>1 <input type="radio" name="opcao" value="2"/>2 <input type="radio" name="opcao" value="3"/>3 <input type="checkbox" name="alterarPneu"></h4> <br/>
            <button type="submit" name="acao" value="alterar"><h3>Confirmar</h3></button>
        </form>
    </body>
</html>
