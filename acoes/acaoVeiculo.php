<?php

$codigoVeiculo = (isset($_POST['codigoVeiculo']) ? $_POST['codigoVeiculo'] : null);
$nome = (isset($_POST['nome']) ? $_POST['nome'] : null);
$marca = (isset($_POST['marca']) ? $_POST['marca'] : null);
$cidade = (isset($_POST['cidade']) ? $_POST['cidade'] : null);
$estado = (isset($_POST['estado']) ? $_POST['estado'] : null);
$placa = (isset($_POST['placa']) ? $_POST['placa'] : null);
$pneu = (isset($_POST['pneu']) ? $_POST['pneu'] : null);
$cor = (isset($_POST['cor']) ? $_POST['cor'] : null);
$motor = (isset($_POST['motor']) ? $_POST['motor'] : null);
$acao = (isset($_POST['acao']) ? $_POST['acao'] : null);

if ($acao == "cadastrar") {
    if ($nome != null && $marca != null && $cidade != null && $estado != null && $placa != null && $pneu != null && $motor != null) {
        cadastrar($nome, $marca, $cidade, $estado, $placa, $pneu, $cor, $motor);
    } else {
        header("location:../erro.php");
    }
} else if ($acao == "alterar") {
    alterarVeiculo($codigoVeiculo, $nome, $marca, $cidade, $estado, $placa, $pneu, $cor, $motor);
} else if ($acao == "excluir") {
    excluirVeiculo($codigoVeiculo);
}

function cadastrar($nome, $marca, $cidade, $estado, $placa, $pneu, $cor, $motor) {
    $conexao = mysqli_connect('localhost', 'root', 'root', 'locacaoveiculos');
    
    $sql = "INSERT INTO veiculo (vec_nome, vec_marca, vec_cidade, vec_estado, vec_placa, vec_pneu, vec_cor, vec_motor)"
                      . "VALUES ('$nome', '$marca', '$cidade', '$estado', '$placa', '$pneu', '$cor', '$motor');";
    
    mysqli_query($conexao, $sql);
    
    if (mysqli_insert_id($conexao)) {
        header("location:../sucessoCadastroVeiculo.php");
    } else {
        header("location:../formularioVeiculo.php");
    }
}

function alterarVeiculo($codigoVeiculo, $nome, $marca, $cidade, $estado, $placa, $pneu, $cor, $motor) {
    $conexao = mysqli_connect('localhost', 'root', 'root', 'locacaoveiculos');
    
    $sql = "SELECT * FROM veiculo WHERE vec_codigo = $codigoVeiculo";
    $result = mysqli_query($conexao, $sql);
    $row = mysqli_fetch_array($result);
    if (!isset($_POST['alterarNome'])) {
        $nome = $row['vec_nome'];
    }
    if (!isset($_POST['alterarMarca'])) {
        $marca = $row['vec_marca'];
    }
    if (!isset($_POST['alterarCidade'])) {
        $cidade = $row['vec_cidade'];
    }
    if (!isset($_POST['alterarEstado'])) {
        $estado = $row['vec_estado'];
    }
    if (!isset($_POST['alterarPlaca'])) {
        $placa = $row['vec_placa'];
    }
    if (!isset($_POST['alterarPneu'])) {
        $pneu = $row['vec_pneu'];
    }
    if (!isset($_POST['alterarCor'])) {
       $cor = $row['vec_cor'];
    }
    if (!isset($_POST['alterarMotor'])) {
        $motor = $row['vec_motor'];
    }
    
    $sql = "UPDATE veiculo "
            . "SET vec_nome = '$nome', vec_marca = '$marca', vec_cidade = '$cidade', vec_estado = '$estado', "
                            . "vec_placa = '$placa', vec_pneu = '$pneu', vec_cor = '$cor', vec_motor = '$motor' "
          . "WHERE vec_codigo = $codigoVeiculo;";
    
    mysqli_query($conexao, $sql);
    header("location:../veiculos.php");
}

function excluirVeiculo($codigoVeiculo) {
    $conexao = mysqli_connect('localhost', 'root', 'root', 'locacaoveiculos');
    
    $sql = "DELETE FROM veiculo WHERE vec_codigo = $codigoVeiculo;";
    
    mysqli_query($conexao, $sql);
    mysqli_insert_id($conexao);
}
