<?php
class Locacao {
    
    private $codigo;
    private $data;
    private $dias;
    private $devolvido;
    private $combustivel;
    private $preco;
    private $clienteNome;
    private $veiculoNome;
    private $opcao;
    
    public function getCodigo() {
        return $this->codigo;
    }

    public function getData() {
        return $this->data;
    }

    public function getDias() {
        return $this->dias;
    }

    public function getDevolvido() {
        return $this->devolvido;
    }

    public function getCombustivel() {
        return $this->combustivel;
    }

    public function getPreco() {
        return $this->preco;
    }

    public function getClienteNome() {
        return $this->clienteNome;
    }

    public function getVeiculoNome() {
        return $this->veiculoNome;
    }

    public function getOpcao() {
        return $this->opcao;
    }

    public function setCodigo($codigo): void {
        $this->codigo = $codigo;
    }

    public function setData($data): void {
        $this->data = $data;
    }

    public function setDias($dias): void {
        $this->dias = $dias;
    }

    public function setDevolvido($devolvido): void {
        $this->devolvido = $devolvido;
    }

    public function setCombustivel($combustivel): void {
        $this->combustivel = $combustivel;
    }

    public function setPreco($preco): void {
        $this->preco = $preco;
    }

    public function setClienteNome($clienteNome): void {
        $this->clienteNome = $clienteNome;
    }

    public function setVeiculoNome($veiculoNome): void {
        $this->veiculoNome = $veiculoNome;
    }

    public function setOpcao($opcao): void {
        $this->opcao = $opcao;
    }
    
    
}
