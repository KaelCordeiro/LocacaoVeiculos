<?php
    session_start();
    if (isset($_SESSION['perfil']) && $_SESSION['perfil'] == "admin") {
        $perfil = $_SESSION['perfil'];
    } else {
        session_destroy();
        header("location:login.php");
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="css/style.css" rel="stylesheet">
        <title>Gráfico de locações</title>
    </head>
    <body class="admin">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">Sair</span>
                </button>
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
                        <?php if ($perfil != "Veículo"): ?>
                            <li><a class="dropdown-item" href="locacoes.php">Alugar um veículo</a></li>
                        <?php endif; ?>

                        <?php if ($perfil != "Veículo"): ?>
                            <li><a class="dropdown-item" href="locacoes.php">Consultar Locações</a></li>
                        <?php endif; ?>

                        <?php if ($perfil == "admin"): ?>
                            <li><a class="dropdown-item" href="locacoesGrafico.php">Gráfico</a></li>
                        <?php endif; ?>
                        </ul>
                    </li>

                        <li class="nav-item">
                          <a class="nav-link" href="#">Veículos</a>
                        </li>

                    </ul>
                    <form class="d-flex" action="acaoLogin.php">
                        <button class="btn btn-dark" name="acao" type="submit" value="logoff">Sair</button>
                    </form>
                </div>
            </div>
        </nav>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {packages: ['corechart', 'bar']});
            google.charts.setOnLoadCallback(desenharGrafico);
            
            function desenharGrafico() {
                var data = new google.visualization.DataTable();

                data.addColumn('string', 'Mês');
                data.addColumn('number', 'Locações');

                data.addRows([
                  ['Janeiro'  , 1],
                  ['Fevereiro', 2],
                  ['Março'    , 3],
                  ['Maio'     , 4],
                  ['Abril'    , 5],
                  ['Junho'    , 6],
                  ['Julho'    , 7],
                  ['Agosto'   , 8],
                  ['Setembro' , 9],
                  ['Outubro'  , 10],
                  ['Novembro' , 11],
                  ['Dezembro' , 12]
                ]);

                var options = {
                    title: 'Locações por mês',
                    hAxis: {
                      title: 'Mês'
                    },
                    vAxis: {
                      title: 'Locações realizadas'
                    }
                };

                var chart = new google.visualization.ColumnChart(
                    document.getElementById('chart_div'));

                chart.draw(data, options);
            }
        </script>
        <div id="chart_div" class="grafico"></div>    
    </body>
</html>
