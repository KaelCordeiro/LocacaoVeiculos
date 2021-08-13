<?php
require '../connect/connect.php';

$cliente = $_POST['nomeCliente'];
$veiculo = $_POST['nomeVeiculo'];
$data = $_POST['data'];
$dias = $_POST['dias'];
$combustivel = $_POST['combustivel'];
$opcao = $_POST['opcao'];
$acao = $_POST['acao'];


if ($acao == "alugar") {
    alugar($cliente, $veiculo, $data, $dias, $combustivel, $opcao);
}

if ($acao == "devolver") {
    
}

if ($acao == "deletar") {
    
}

function alugar($cliente, $veiculo, $data, $dias, $combustivel, $opcao) {
    $sql = "SELECT clt_codigo "
           . "FROM usuario_cliente "
          . "WHERE clt_nome = '$cliente';";
    
    $result = mysqli_query($GLOBALS['conexao'], $sql);
    $codigoCliente = mysqli_fetch_array($result);
    
    $sql = "SELECT vec_codigo "
           . "FROM veiculo "
          . "WHERE vec_nome = '$veiculo';";
    
    $result = mysqli_query($GLOBALS['conexao'], $sql);
    $codigoVeiculo = mysqli_fetch_array($result);
    
    $sql = "INSERT INTO locacao_vendedor_cliente (loc_codigo, loc_data, loc_dias, loc_devolvido, loc_combustivel, loc_preco, clt_codigo, vec_codigo, opc_codigo)"
                                       . "VALUES (null, '$data', $dias, 0, $combustivel, 0, $codigoCliente[0], $codigoVeiculo[0], $opcao);";
    
    $result = mysqli_query($GLOBALS['conexao'], $sql);
    
    if (mysqli_insert_id($GLOBALS['conexao'])) {
        header("location:../sucesso.php");
    } else {
        header("location:../formularioLocacao.php");
    }
}

function devolver() {
    
}

function deletar() {
    
}
