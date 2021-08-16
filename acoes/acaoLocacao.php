<?php

$codigoLocacao = (isset($_POST['codigoLocacao']) ? $_POST['codigoLocacao'] : null);
$cliente = (isset($_POST['nomeCliente']) ? $_POST['nomeCliente'] : null);
$veiculo = (isset($_POST['nomeVeiculo']) ? $_POST['nomeVeiculo'] : null);
$data = (isset($_POST['data']) ? $_POST['data'] : null);
$dias = (isset($_POST['dias']) ? $_POST['dias'] : null);
$devolvido = (isset($_POST['devolvido']) ? $_POST['devolvido'] : null);
$combustivel = (isset($_POST['combustivel']) ? $_POST['combustivel'] : null);
$opcao = (isset($_POST['opcao']) ? $_POST['opcao'] : null);
$preco = (isset($_POST['preco']) ? $_POST['preco'] : null);
$acao = (isset($_POST['acao']) ? $_POST['acao'] : null);

if ($acao == "alugar") {
    if ($cliente != null && $veiculo != null && $data != null && $dias != null && $combustivel != null && $opcao != null) {
        alugar($cliente, $veiculo, $data, $dias, $combustivel, $opcao);
    } else {
        header("location:../erro.php");
    }
}

if ($acao == "devolver") {
    if ($codigoLocacao != null && $combustivel != null && $opcao != null) {
        devolverVeiculo($codigoLocacao, $combustivel, $opcao);
    }
}

if ($acao == "excluir") {
    excluirLocacao($codigoLocacao);
}

if ($acao == "alterar") {
    alterarLocacao($codigoLocacao, $cliente, $veiculo, $data, $dias, $devolvido, $combustivel, $opcao, $preco);
}

function alugar($cliente, $veiculo, $data, $dias, $combustivel, $opcao) {
    $conexao = mysqli_connect('localhost', 'root', 'root', 'locacaoveiculos');
    
    $sql = "SELECT clt_codigo "
           . "FROM usuario_cliente "
          . "WHERE clt_nome = '$cliente';";
    
    $result = mysqli_query($conexao, $sql);
    $codigoCliente = mysqli_fetch_array($result);
    
    $sql = "SELECT vec_codigo "
           . "FROM veiculo "
          . "WHERE vec_nome = '$veiculo';";
    
    $result = mysqli_query($conexao, $sql);
    $codigoVeiculo = mysqli_fetch_array($result);
    
    $sql = "INSERT INTO locacao (loc_codigo, loc_data, loc_dias, loc_devolvido, loc_combustivel, loc_preco, clt_codigo, vec_codigo, opc_codigo)"
                      . "VALUES (null, '$data', $dias, 0, $combustivel, 0, $codigoCliente[0], $codigoVeiculo[0], $opcao);";
    
    mysqli_query($conexao, $sql);
    
    if (mysqli_insert_id($conexao)) {
        header("location:../sucessoLocacao.php");
    } else {
        header("location:../erro.php");
    }
}

function devolverVeiculo($codigoLocacao, $combustivel, $opcao) {
    $conexao = mysqli_connect('localhost', 'root', 'root', 'locacaoveiculos');
    
    $sql = "SELECT loc_combustivel "
           . "FROM locacao "
          . "WHERE loc_codigo = $codigoLocacao;";
    
    $result = mysqli_query($conexao, $sql);
    $resultadoQuery = mysqli_fetch_array($result);
    $combustivelLocacao = $resultadoQuery[0];
    
    if ($combustivel != $combustivelLocacao) {
        header("location:../locacoes.php");
    } else {
        $preco = 0;
        switch ($opcao) {
            case 1:
                $preco = opcao1();
                break;
            case 2:
                $preco = opcao2();
                break;
            case 3:
                $preco = opcao3();
                break;
        }
        $sql = "UPDATE locacao SET loc_preco = $preco, loc_devolvido = 1 WHERE loc_codigo = $codigoLocacao;";
        $result = mysqli_query($conexao, $sql);
        header("location:../sucessoDevolucao.php");
    }
}

function opcao1() { //50 REAIS POR DIA
    $preco = 0;
    $dias = $_POST['dias'];
    $horario = $_POST['horarioDevolucao'];
    $hora = explode(':', $horario);
    if (intval($hora[0]) > 15) {
        $preco = ($dias * 50);
    } else {
        $preco = (($dias - 1) * 50) + 25;
    }
    return $preco;
}

function opcao2() { //20 REAIS POR HORA
    $preco;
    $tempoUso = $_POST['tempoUso'];
    $tempo = explode($tempoUso, ':');
    $minutos = intval($tempo[1]);
    if ($minutos > 20) {
        $preco = intval($tempo[0]) * 20;
    } else {
        $preco = ((intval($tempo[0]) - 1) * 20) + 10;
    }

    return $preco;
}

function opcao3() { //10 REAIS POR KILOMETRO
    $preco;
    $km = $_POST['km'];
    $preco = intval($km) * 10;
    return $preco;
}

function excluirLocacao($codigoLocacao) {
    $conexao = mysqli_connect('localhost', 'root', 'root', 'locacaoveiculos');
    
    $sql = "DELETE FROM locacao WHERE loc_codigo = $codigoLocacao;";
    
    mysqli_query($conexao, $sql);
    mysqli_insert_id($conexao);
}

function alterarLocacao($codigoLocacao, $cliente, $veiculo, $data, $dias, $devolvido, $combustivel, $opcao, $preco) {
    $conexao = mysqli_connect('localhost', 'root', 'root', 'locacaoveiculos');
    
    $sql = "SELECT * FROM locacao WHERE loc_codigo = $codigoLocacao";
    $result = mysqli_query($conexao, $sql);
    $row = mysqli_fetch_array($result);
    
    if (!isset($_POST['alterarNomeCliente'])) {
        $cliente = $row['clt_codigo'];
    } else {
        $sql = "SELECT clt_codigo FROM usuario_cliente WHERE clt_nome = '$cliente';";
        $resultado = mysqli_query($conexao, $sql);
        $linha = mysqli_fetch_array($resultado);
        $cliente = $linha['clt_codigo'];
    }
    
    if (!isset($_POST['alterarNomeVeiculo'])) {
        $veiculo = $row['vec_codigo'];
    } else {
        $sql = "SELECT vec_codigo FROM veiculo WHERE vec_nome = '$veiculo';";
        $resultado = mysqli_query($conexao, $sql);
        $linha = mysqli_fetch_array($resultado);
        $veiculo = $linha['vec_codigo'];
    }
    
    if (!isset($_POST['alterarData'])) {
        $data = $row['loc_data'];
    }
    if (!isset($_POST['alterarDias'])) {
        $dias = $row['loc_dias'];
    }
    if (!isset($_POST['alterarDevolvido'])) {
        $devolvido = $row['loc_devolvido'];
    }
    if (!isset($_POST['alterarCombustivel'])) {
        $combustivel = $row['loc_combustivel'];
    }
    if (!isset($_POST['alterarPreco'])) {
        $preco = $row['loc_preco'];
    }
    if (!isset($_POST['alterarOpcao'])) {
       $opcao = $row['opc_codigo'];
    }
    
    $sql = "UPDATE locacao "
            . "SET loc_data = '$data', loc_dias = $dias, loc_devolvido = $devolvido, loc_combustivel = $combustivel, "
                . "loc_preco = $preco, clt_codigo = $cliente[0], vec_codigo = $veiculo[0], opc_codigo = $opcao "
          . "WHERE loc_codigo = $codigoLocacao;";
    
    mysqli_query($conexao, $sql);
    header("location:../locacoes.php");
}

function pegaLocacao($codigoLocacao) {
    $conexao = mysqli_connect('localhost', 'root', 'root', 'locacaoveiculos');
    
    $sql = "SELECT loc_codigo, clt_nome, vec_nome, loc_data, loc_dias, loc_devolvido, loc_combustivel, loc_preco, opc_codigo "
           . "FROM locacao "
           . "JOIN veiculo "
           ."USING (vec_codigo) "
            ."JOIN usuario_cliente "
           ."USING (clt_codigo) "
            ."JOIN opcao "
          . "USING (opc_codigo) "
          . "WHERE loc_codigo = $codigoLocacao;";
    
    $result = mysqli_query($conexao, $sql);
    $row = mysqli_fetch_array($result);
    
    return $row;   
}

