<?php

// ==================================================
// CLASSE OPERADOR
// Representa o profissional responsável pela operação.
// ==================================================

class Operador
{
    // Atributos privados que armazenam os dados do operador.
    private string $nomeOperador;
    private string $matriculaOperador;
    private string $cargoOperador;

    // Inicializa os atributos ao criar um objeto Operador.
    public function __construct(
        string $nomeOperador,
        string $matriculaOperador,
        string $cargoOperador
    ) {
        $this->nomeOperador = $nomeOperador;
        $this->matriculaOperador = $matriculaOperador;
        $this->cargoOperador = $cargoOperador;
    }

    // Retorna o nome do operador.
    public function getNomeOperador(): string
    {
        return $this->nomeOperador;
    }

    // Retorna a matrícula do operador.
    public function getMatriculaOperador(): string
    {
        return $this->matriculaOperador;
    }

    // Retorna o cargo do operador.
    public function getCargoOperador(): string
    {
        return $this->cargoOperador;
    }
}