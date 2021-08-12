<?php

class Veiculo {
    
    private $codigo;
    private $nome;
    private $marca;
    private $cidade;
    private $estado;
    private $placa;
    private $pneu;
    private $cor;
    private $motor;
    
    public function getCodigo() {
        return $this->codigo;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getMarca() {
        return $this->marca;
    }

    public function getCidade() {
        return $this->cidade;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getPlaca() {
        return $this->placa;
    }

    public function getPneu() {
        return $this->pneu;
    }

    public function getCor() {
        return $this->cor;
    }

    public function getMotor() {
        return $this->motor;
    }

    public function setCodigo($codigo): void {
        $this->codigo = $codigo;
    }

    public function setNome($nome): void {
        $this->nome = $nome;
    }

    public function setMarca($marca): void {
        $this->marca = $marca;
    }

    public function setCidade($cidade): void {
        $this->cidade = $cidade;
    }

    public function setEstado($estado): void {
        $this->estado = $estado;
    }

    public function setPlaca($placa): void {
        $this->placa = $placa;
    }

    public function setPneu($pneu): void {
        $this->pneu = $pneu;
    }

    public function setCor($cor): void {
        $this->cor = $cor;
    }

    public function setMotor($motor): void {
        $this->motor = $motor;
    }
    
    
}
