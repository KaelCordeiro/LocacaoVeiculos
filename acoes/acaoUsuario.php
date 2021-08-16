<?php

function ativarCliente ($codigoCliente) {
    $conexao = mysqli_connect('localhost', 'root', 'root', 'locacaoveiculos');
    
    $sql = "SELECT log_codigo "
           . "FROM login "
           . "JOIN usuario_cliente "
        .   "USING (log_codigo) "
          . "WHERE clt_codigo = $codigoCliente;";
    
    $result = mysqli_query($conexao, $sql);
    $codigoLoginCliente = mysqli_fetch_array($result);
    
    $sql = "UPDATE login "
            . "SET log_ativo = 1 "
          . "WHERE log_codigo = $codigoLoginCliente[0];";
    
    mysqli_query($conexao, $sql);
    mysqli_insert_id($conexao);
}

function desativarCliente ($codigoCliente) {
    $conexao = mysqli_connect('localhost', 'root', 'root', 'locacaoveiculos');
    
    $sql = "SELECT log_codigo "
           . "FROM login "
           . "JOIN usuario_cliente "
        .   "USING (log_codigo) "
          . "WHERE clt_codigo = $codigoCliente;";
    
    $result = mysqli_query($conexao, $sql);
    $codigoLoginCliente = mysqli_fetch_array($result);
    
    $sql = "UPDATE login "
           . "SET  log_ativo = 0 "
          . "WHERE log_codigo = $codigoLoginCliente[0];";
    
    mysqli_query($conexao, $sql);
    mysqli_insert_id($conexao);
}

function ativarVendedor ($codigoVendedor) {
    $conexao = mysqli_connect('localhost', 'root', 'root', 'locacaoveiculos');
    
    $sql = "SELECT log_codigo "
           . "FROM login "
           . "JOIN usuario_vendedor "
        .   "USING (log_codigo) "
          . "WHERE ven_codigo = $codigoVendedor;";
    
    $result = mysqli_query($conexao, $sql);
    $codigoLoginVendedor = mysqli_fetch_array($result);
    
    $sql = "UPDATE login "
            . "SET log_ativo = 1 "
          . "WHERE log_codigo = $codigoLoginVendedor[0];";
    
    mysqli_query($conexao, $sql);
    mysqli_insert_id($conexao);
}

function desativarVendedor ($codigoVendedor) {
    $conexao = mysqli_connect('localhost', 'root', 'root', 'locacaoveiculos');
    
    $sql = "SELECT log_codigo "
           . "FROM login "
           . "JOIN usuario_vendedor "
        .   "USING (log_codigo) "
          . "WHERE ven_codigo = $codigoVendedor;";
    
    $result = mysqli_query($conexao, $sql);
    $codigoLoginVendedor = mysqli_fetch_array($result);
    
    $sql = "UPDATE login "
           . "SET  log_ativo = 0 "
          . "WHERE log_codigo = $codigoLoginVendedor[0];";
    
    mysqli_query($conexao, $sql);
    mysqli_insert_id($conexao);
}



