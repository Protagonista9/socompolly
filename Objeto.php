<?php

class Objeto {
    protected string $nome;
    protected string $descricao;
    protected string $referencia; // Manual em PDF

    public function __construct(string $nome = "", string $descricao = "", string $referencia = "") {
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->referencia = $referencia;
    }

    public function getNome(): string {
        return $this->nome;
    }

    public function setNome(string $nome): void {
        $this->nome = $nome;
    }

    public function getDescricao(): string {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): void {
        $this->descricao = $descricao;
    }

    public function getReferencia(): string {
        return $this->referencia;
    }

    public function setReferencia(string $referencia): void {
        $this->referencia = $referencia;
    }
}