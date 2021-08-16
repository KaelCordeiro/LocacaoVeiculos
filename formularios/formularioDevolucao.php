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
        <script src="../js/ajax.js"></script>
        <title>Devolver veículo</title>
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
            <h1>Devolução de veículo</h1> <br/>
            <h3>Informe os dados necessários para a devolução</h3> <br/>
            <input type='hidden' name='codigoLocacao' value='<?php echo $_POST['codigoLocacao'] ?>'/>
            <?php 
                require_once '../acoes/acaoLocacao.php';
                require_once '../classes/Locacao.php';
                
                $codigoLocacao = $_POST['codigoLocacao'];
                $row = pegaLocacao($codigoLocacao);
                
                $locacao = new Locacao();
                $locacao->setCodigo($row['loc_codigo']);
                $locacao->setClienteNome($row['clt_nome']);
                $locacao->setVeiculoNome($row['vec_nome']);
                $locacao->setData($row['loc_data']);
                $locacao->setDias($row['loc_dias']);
                $locacao->setDevolvido($row['loc_devolvido']);
                $locacao->setCombustivel($row['loc_combustivel']);
                $locacao->setOpcao($row['opc_codigo']);
                
            ?>
            <?php if ($locacao->getOpcao() == 1) :?>
                <h3>Opção de pagamento: 1 - Por dia</h3> <br/>
                <h4>OBS: Se o veículo for devolvido até 15:00h será cobrado meia diária</h4> <br/>
                <h4>Dias de uso: <input type="number" name="dias"/></h4> <br/>
                <h4>Horário da devolução: <input type="time" name="horarioDevolucao"/></h4> <br/>
            <?php endif;?>
                
            <?php if ($locacao->getOpcao() == 2) :?>
                <h4>Opção de pagamento: 2 - Por hora</h4> <br/>
                <h1>OBS: Em fração de hora maior que vinte minutos, será cobrada hora cheia</h1> <br/>
                <h4>Tempo total de uso: <input type="time" name="tempoUso"/></h4> <br/>
            <?php endif;?>
                
            <?php if ($locacao->getOpcao() == 3) :?>
                <h4>Opção de pagamento: 3 - Por km rodado</h4> <br/>
                <h1>OBS: Em fração maior que 400m, será cobrado km completo</h1> <br/>
                <h4>Quilômetros rodados: <input type="number" name="km"/></h4> <br/>
            <?php endif;?>
                <input type='hidden' name='opcao' value='<?php echo $locacao->getOpcao(); ?>'/>
                <h4>Quantidade de combustível no tanque: <input type="number" id="combustivel" name="combustivel" onblur="combustivelAjax(<?php echo $locacao->getCodigo(); ?>)"/></h4> <br/>
            <button type="submit" name="acao" value="devolver"><h3>Devolver</h3></button>
        </form>
    </body>
</html>
