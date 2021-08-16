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
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="css/style.css" rel="stylesheet">
        <title>Veículos</title>
    </head>
    <body class="<?php echo $perfil ?>">
        <body class="<?php echo $perfil ?>">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><?php echo $perfil ?></a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="index.php">Início</a>
                </li>
                
                <?php if ($perfil == "admin"): ?>
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
                <?php endif; ?>
                
                <?php if ($perfil != "Veículo"): ?>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Locações
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php if ($perfil != "Veículo"): ?>
                    <li><a class="dropdown-item" href="formularios/formularioLocacao.php">Alugar um veículo</a></li>
                    <?php endif; ?>
                     
                    <li><a class="dropdown-item" href="locacoes.php"> <?php echo ($perfil == "Cliente" ? "Minhas locações" : "Consultar locações"); ?></a></li>
                        <?php if ($perfil == "admin"): ?>
                        <li><a class="dropdown-item" href="locacoesGrafico.php">Gráfico de locações</a></li>
                        <?php endif; ?>

                  </ul>
                </li>
                <?php endif; ?>
                
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Veículos
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <li><a class="dropdown-item" href="veiculos.php">Consultar veículos</a></li>
                    <?php if ($perfil == "admin" || $perfil == "Vendedor"): ?>
                    <li><a class="dropdown-item" href="formularios/formularioVeiculo.php">Cadastrar um veículo</a></li>
                    <?php endif; ?>
                  </ul>
                </li>
                
              </ul>
                <form class="d-flex" action="acoes/acaoLogin.php">
                    <button class="btn btn-dark" name="acao" type="submit" value="logoff">Sair</button>
                </form>
          </div>
      </div>
    </nav>

        <table class="table table-hover">
            <tr style="background-color: whitesmoke">
                <th colspan="<?php echo $colspan = (($perfil != "Cliente" && $perfil != "Veículo") ? 10 : 9) ?>" style="text-align: center">Tabela de Veículos</th>
            </tr>
            <tr style="background-color: whitesmoke">
                <th>Código</th>
                <th>Nome</th>
                <th>Marca</th>
                <th>Cidade</th>
                <th>Estado</th>
                <th>Placa</th>
                <th>Pneu</th>
                <th>Cor</th>
                <th>Motor</th>
                <?php if ($perfil != "Cliente" && $perfil != "Veículo") :?>
                <th>Ações</th>
                <?php endif; ?>
            </tr>
            <?php  
                require 'acoes/acaoListar.php';
                require 'acoes/acaoVeiculo.php';
                
                if (isset($_POST['acao'])) {
                    $acao = $_POST['acao'];
                    $codigoVeiculo = $_POST['codigoVeiculo'];
                    if ($acao == "excluir") {
                        excluirVeiculo($codigoVeiculo);
                    }
                }
                
                $veiculos = listarVeiculos();
                foreach ($veiculos as $veiculo) {
                    echo '<tr style="background-color: whitesmoke">';
                    echo    '<td>'.$veiculo->getCodigo().'</td>';
                    echo    '<td>'.$veiculo->getNome().'</td>';
                    echo    '<td>'.$veiculo->getMarca().'</td>';
                    echo    '<td>'.$veiculo->getCidade().'</td>';
                    echo    '<td>'.$veiculo->getEstado().'</td>';
                    echo    '<td>'.$veiculo->getPlaca().'</td>';
                    echo    '<td>'.$veiculo->getPneu().'</td>';
                    echo    '<td>'.$veiculo->getCor().'</td>';
                    echo    '<td>'.$veiculo->getMotor().'</td>';
                    if ($perfil != "Cliente" && $perfil != "Veículo") {
                        echo    '<td>';
                        echo        "<form action='formularios/formularioAlterarVeiculo.php' method='POST'>";
                        echo            "<input type='hidden' name='codigoVeiculo' value='{$veiculo->getCodigo()}'/>";
                        echo            "<button type='submit' name='acao' value='alterar'>Alterar</button>";
                        echo        '</form>';
                        echo        "<form action='?' method='POST'>";
                        echo            "<input type='hidden' name='codigoVeiculo' value='{$veiculo->getCodigo()}'/>";
                        echo            "<button type='submit' name='acao' value='excluir'>Excluir</button>";
                        echo        '</form>';
                        echo '</tr>';
                    }
                }
            ?>
        </table>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </body>
</html>
