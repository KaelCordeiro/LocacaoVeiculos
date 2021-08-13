<?php
    session_start();
    if (isset($_SESSION['perfil'])) {
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
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                      <a class="nav-link active" aria-current="page" href="index.php">Início</a>
                    </li>

                    <?php if ($perfil == "admin"): ?>
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Usuários
                      </a>
                      <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Cliente</a></li>
                        <li><a class="dropdown-item" href="#">Vendedor</a></li>
                      </ul>
                    </li>
                    <?php endif; ?>

                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Locações
                      </a>
                      <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php if ($perfil == "Cliente" || $perfil == "Admin"): ?>
                        <li><a class="dropdown-item" href="formularioLocacao.php">Alugar um veículo</a></li>
                        <?php endif; ?>

                        <?php if ($perfil != "Veiculo"): ?>
                        <li><a class="dropdown-item" href="locacoes.php">Consultar Locações</a></li>
                        <?php endif; ?>

                        <?php if ($perfil == "admin"): ?>
                        <li><a class="dropdown-item" href="locacoesGrafico.php">Gráfico de locações</a></li>
                        <?php endif; ?>
                      </ul>
                    </li>

                    <li class="nav-item">
                      <a class="nav-link" href="#">Veículos</a>
                    </li>

                  </ul>
                    <form class="d-flex" action="acoes/acaoLogin.php">
                        <button class="btn btn-dark" name="acao" type="submit" value="logoff">Sair</button>
                     </form>
                </div>
            </div>
        </nav>
        <form action="index.php" method="POST" class="col-md-12 text-center" style="margin-top: 150px">
            <h1>Locação informada com sucesso!</h1> <br/> <br/> <br/> 
            <button type="submit"><h3>Retornar à página inicial</h3></button>
        </form>
    </body>
</html>
