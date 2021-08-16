<?php
    session_start();
    if (isset($_SESSION['perfil']) && $_SESSION['perfil'] != "Veículo") {
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
        <title>Formulário de Locação</title>
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
            <h1>Formulário de locação</h1> <br/>
            <h2>Preencha os dados abaixo e clique no botão abaixo para realizar o cadastro</h2> <br/> <br/> <br/>
            <h4>Nome do Cliente: <input type="text" name="nomeCliente"/></h4>  <br/>
            <h4>Nome do Veículo: <input type="text" name="nomeVeiculo"/></h4> <br/>
            <h4>Data: <input type="datetime-local" name="data"/></h4> <br/>
            <h4>Quantidade de dias: <input type="number" name="dias"/> <br/></h4> <br/>
            <h4>Combustível (litros): <input type="number" name="combustivel"/></h4> <br/>
            <h4>
                Opção de pagamento:
                <select name="opcao">
                    <option selected="true" disabled="true">Opção</option>
                    <option value="1">1 - Por dia</option>
                    <option value="2">2 - Por hora</option>
                    <option value="3">3 - Por km rodado</option>
                </select>
            </h4> <br/>
            <button type="submit" name="acao" value="alugar"><h3>Confirmar</h3></button>
        </form>
    </body>
</html>
