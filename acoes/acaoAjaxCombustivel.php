<?php

$codigoLocacao = filter_input(INPUT_POST, 'codigoLocacao');

$conexao = mysqli_connect('localhost', 'root', 'root', 'locacaoveiculos');
    
$sql = "SELECT loc_combustivel FROM locacao WHERE loc_codigo = $codigoLocacao;";

$result = mysqli_query($conexao, $sql);
$row = mysqli_fetch_array($result);

echo $row['loc_combustivel'];
