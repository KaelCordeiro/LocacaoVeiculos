<?php
class Vendedor {
    
    private $codigo;
    private $nome;
    private $ativado;
    
    public function getCodigo() {
        return $this->codigo;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getAtivado() {
        return $this->ativado;
    }

    public function setCodigo($codigo): void {
        $this->codigo = $codigo;
    }

    public function setNome($nome): void {
        $this->nome = $nome;
    }

    public function setAtivado($ativado): void {
        $this->ativado = $ativado;
    }
    
    
}
