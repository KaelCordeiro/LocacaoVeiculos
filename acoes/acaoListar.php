<?php

require 'connect/connect.php';
require 'classes/Veiculo.php';

function listarVeiculos() {

    $sql = "SELECT * FROM veiculo;";
    $result = mysqli_query($GLOBALS['conexao'], $sql);
    $row = mysqli_fetch_array($result);
    $veiculos = [];

    foreach ($row as $linha) {
        $veiculo = new Veiculo();
        $veiculo->setNome($linha['vec_nome']);
        $veiculo->setMarca($linha['vec_marca']);
        $veiculo->setCidade($linha['vec_cidade']);
        $veiculo->setEstado($linha['vec_estado']);
        $veiculo->setPlaca($linha['vec_placa']);
        $veiculo->setPneu($linha['vec_pneu']);
        $veiculo->setCor($linha['vec_cor']);
        $veiculo->setMotor($linha['vec_motor']);
        $veiculos[] = $veiculo;
    }

    return $veiculos;
}
