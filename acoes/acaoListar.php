<?php
require_once 'classes/Cliente.php';
require_once 'classes/Locacao.php';
require_once 'classes/Veiculo.php';
require_once 'classes/Vendedor.php';

function listarClientes() {
    
    $conexao = mysqli_connect('localhost', 'root', 'root', 'locacaoveiculos');
    
    $sql = "SELECT clt_codigo, clt_nome, log_ativo FROM usuario_cliente JOIN login USING (log_codigo)";
    $result = mysqli_query($conexao, $sql);
    $clientes =[];
    
    while ($row = mysqli_fetch_array($result)) {
        $cliente = new Cliente();
        $cliente->setNome($row['clt_nome']);
        $cliente->setCodigo($row['clt_codigo']);
        $cliente->setAtivado($row['log_ativo']);
        
        $clientes[] = $cliente;
    }

    return $clientes;
}

function listarVendedores() {
    $conexao = mysqli_connect('localhost', 'root', 'root', 'locacaoveiculos');
    
    $sql = "SELECT ven_codigo, ven_nome, log_ativo FROM usuario_vendedor JOIN login USING (log_codigo)";
    $result = mysqli_query($conexao, $sql);
    $vendedores =[];
    
    while ($row = mysqli_fetch_array($result)) {
        $vendedor = new Vendedor();
        $vendedor->setNome($row['ven_nome']);
        $vendedor->setCodigo($row['ven_codigo']);
        $vendedor->setAtivado($row['log_ativo']);
        
        $vendedores[] = $vendedor;
    }

    return $vendedores;
}

function listarVeiculos() {
    $conexao = mysqli_connect('localhost', 'root', 'root', 'locacaoveiculos');
    
    $sql = "SELECT * FROM veiculo;";
    $result = mysqli_query($conexao, $sql);
    $veiculos =[];
    
    while ($row = mysqli_fetch_array($result)) {
        $veiculo = new Veiculo();
        $veiculo->setCodigo($row['vec_codigo']);
        $veiculo->setNome($row['vec_nome']);
        $veiculo->setMarca($row['vec_marca']);
        $veiculo->setCidade($row['vec_cidade']);
        $veiculo->setEstado($row['vec_estado']);
        $veiculo->setPlaca($row['vec_placa']);
        $veiculo->setPneu($row['vec_pneu']);
        $veiculo->setCor($row['vec_cor']);
        $veiculo->setMotor($row['vec_motor']);
        
        $veiculos[] = $veiculo;
    }

    return $veiculos;
}

function listarLocacoes() {
    $conexao = mysqli_connect('localhost', 'root', 'root', 'locacaoveiculos');
    
    $sql = "SELECT loc_codigo, clt_nome, vec_nome, loc_data, loc_dias, loc_devolvido, loc_combustivel, loc_preco, opc_codigo "
           . "FROM locacao "
           . "JOIN veiculo "
           ."USING (vec_codigo) "
            ."JOIN usuario_cliente "
           ."USING (clt_codigo) "
            ."JOIN opcao "
          . "USING (opc_codigo)";
    
    if ($_SESSION['perfil'] == "Cliente") {
        $logCodigo = $_SESSION['codigo'];
        $sqlClienteLogado = "SELECT clt_codigo FROM usuario_cliente WHERE log_codigo = $logCodigo";
        $resultado = mysqli_query($conexao, $sqlClienteLogado);
        $linha = mysqli_fetch_array($resultado);
        $codigoClienteLogado = $linha['clt_codigo'];
        $sql .= " WHERE clt_codigo = $codigoClienteLogado";
    }
    
    $sql .= ";";
    
    $result = mysqli_query($conexao, $sql);
    $locacoes =[];
    
    while ($row = mysqli_fetch_array($result)) {
        $locacao = new Locacao();
        $locacao->setCodigo($row['loc_codigo']);
        $locacao->setData($row['loc_data']);
        $locacao->setDias($row['loc_dias']);
        $locacao->setDevolvido($row['loc_devolvido']);
        $locacao->setCombustivel($row['loc_combustivel']);
        $locacao->setPreco($row['loc_preco']);
        $locacao->setClienteNome($row['clt_nome']);
        $locacao->setVeiculoNome($row['vec_nome']);
        $locacao->setOpcao($row['opc_codigo']);
        
        $locacoes[] = $locacao;
    }

    return $locacoes;
}



function listarLocacoesGrafico($mes) { 
    $sql = "SELECT MONTHNAME(loc_data) AS Mes, COUNT(loc_codigo) AS Locacoes FROM locacao WHERE monthname(loc_data) = '$mes' GROUP BY Mes";
    $conexao = mysqli_connect('localhost', 'root', 'root', 'locacaoveiculos');
    $result = mysqli_query($conexao, $sql);
    $row = mysqli_fetch_array($result);
    $locacoes = (!empty($row['Locacoes']) ? $row['Locacoes'] : 0);
    
    return $locacoes;
}
