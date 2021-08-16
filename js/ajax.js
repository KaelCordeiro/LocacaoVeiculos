function combustivelAjax(codigoLocacao) {
    
    var ajax = new XMLHttpRequest();
    var parametro = 'codigoLocacao='+codigoLocacao;
    ajax.open('POST', 'http://localhost/LocacaoVeiculos/acoes/acaoAjaxCombustivel.php');
    ajax.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    
    ajax.onreadystatechange = function() {
        if (ajax.status === 200 && ajax.readyState === 4) {
            var combustivelLocacao = parseInt(ajax.responseText);
            window.alert('ALERTA: O veículo deve ser devolvido com a mesma quantidade de combustível do dia da locação ('+combustivelLocacao+')');
        }
    }
    
    ajax.send(parametro);

}


