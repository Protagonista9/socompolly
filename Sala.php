<?php

require_once 'Objeto.php';

class Sala extends Objeto {
    private string $numero;

    public function __construct(string $nome = "", string $numero = "", string $descricao = "", string $referencia = "") {
        parent::__construct($nome, $descricao, $referencia);
        $this->numero = $numero;
    }

    public function getNumero(): string {
        return $this->numero;
    }

    public function setNumero(string $numero): void {
        $this->numero = $numero;
    }
}