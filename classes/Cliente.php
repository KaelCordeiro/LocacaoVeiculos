<?php

class Cliente {
    
    private $nome;
    private $codigo;
    
    public function getNome() {
        return $this->nome;
    }

    public function getCodigo() {
        return $this->codigo;
    }

    public function setNome($nome): void {
        $this->nome = $nome;
    }

    public function setCodigo($codigo): void {
        $this->codigo = $codigo;
    }
    
    
}
