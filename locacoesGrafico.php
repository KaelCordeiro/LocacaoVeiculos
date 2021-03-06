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
            <a class="navbar-brand" href="index.php"><?php echo $perfil ?></a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="index.php">Início</a>
                </li>

                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Documentos
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="relatorios/ExcelPrincipal.php">Relatório Principal (Excel) - Download</a></li>
                    <li><a class="dropdown-item" href="relatorios/WordPrincipal.php">Relatório Principal (Word) - Download</a></li>
                    <li><a class="dropdown-item" href="relatorios/ExcelUsuCliente.php">Clientes (Excel) - Download</a></li>
                    <li><a class="dropdown-item" href="relatorios/WordUsuCliente.php">Clientes (Word) - Download</a></li>
                    <li><a class="dropdown-item" href="relatorios/ExcelUsuVendedor.php">Vendedores (Excel) - Download</a></li>
                    <li><a class="dropdown-item" href="relatorios/WordUsuVendedor.php">Vendedores (Word - Download)</a></li>
                    <li><a class="dropdown-item" href="relatorios/ExcelLocacao.php">Locações (Excel) - Download</a></li>
                    <li><a class="dropdown-item" href="relatorios/WordLocacao.php">Locações (Word) - Download</a></li>
                    <li><a class="dropdown-item" href="relatorios/ExcelOpcao.php">Opções de Pagamento (Excel) - Download</a></li>
                    <li><a class="dropdown-item" href="relatorios/WordOpcao.php">Opções de Pagamento (Word) - Download</a></li>
                    <li><a class="dropdown-item" href="relatorios/ExcelUsuario.php">Perfis (Excel) - Download</a></li>
                    <li><a class="dropdown-item" href="relatorios/WordUsuario.php">Perfis (Word) - Download</a></li>
                    <li><a class="dropdown-item" href="relatorios/ExcelLogin.php">Logins registrados (Excel) - Download</a></li>
                    <li><a class="dropdown-item" href="relatorios/WordLogin.php">Logins registrados (Word) - Download</a></li>
                  </ul>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Usuários
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="clientes.php">Cliente</a></li>
                    <li><a class="dropdown-item" href="vendedores.php">Vendedor</a></li>
                  </ul>
                </li>
                
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Locações
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="formularioLocacao.php">Alugar um veículo</a></li>          
                    <li><a class="dropdown-item" href="locacoes.php">Consultar Locações</a></li>
                    <li><a class="dropdown-item" href="locacoesGrafico.php">Gráfico de locações</a></li>
                  </ul>
                </li>
                
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Veículos
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="veiculos.php">Consultar veículos</a></li>
                    <li><a class="dropdown-item" href="formularioVeiculo.php">Cadastrar um veículo</a></li>
                  </ul>
                </li>
                
              </ul>
                <form class="d-flex" action="acoes/acaoLogin.php">
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
                  ['Janeiro'  , <?php include 'acoes/acaoListar.php'; echo listarLocacoesGrafico('January');?>],
                  ['Fevereiro', <?php echo listarLocacoesGrafico('February');?>],
                  ['Março'    , <?php echo listarLocacoesGrafico('March');?>],
                  ['Abril'    , <?php echo listarLocacoesGrafico('April');?>],
                  ['Maio'     , <?php echo listarLocacoesGrafico('May')?>],
                  ['Junho'    , <?php echo listarLocacoesGrafico('June');?>],
                  ['Julho'    , <?php echo listarLocacoesGrafico('July');?>],
                  ['Agosto'   , <?php echo listarLocacoesGrafico('August');?>],
                  ['Setembro' , <?php echo listarLocacoesGrafico('September');?>],
                  ['Outubro'  , <?php echo listarLocacoesGrafico('October');?>],
                  ['Novembro' , <?php echo listarLocacoesGrafico('November');?>],
                  ['Dezembro' , <?php echo listarLocacoesGrafico('December');?>]
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
