<?php

// Importa a classe Turbina e suas dependências.
require_once __DIR__ . "/turbinaclass.php";

// ==================================================
// CLASSE USINA
// Representa a usina e seus indicadores operacionais.
// ==================================================

class Usina
{
    // Atributos privados que armazenam os dados da usina.
    private string $nomeUsina;
    private float $nivelReservatorio;
    private float $vazao;
    private float $potenciaGerada;
    private array $turbinas;

    // Inicializa os indicadores e a coleção de turbinas.
    public function __construct(
        string $nomeUsina,
        float $nivelReservatorio,
        float $vazao,
        float $potenciaGerada,
        array $turbinas
    ) {
        // Garante que todos os elementos sejam objetos Turbina.
        foreach ($turbinas as $turbina) {
            if (!$turbina instanceof Turbina) {
                throw new InvalidArgumentException(
                    "A lista deve conter apenas objetos da classe Turbina."
                );
            }
        }

        $this->nomeUsina = $nomeUsina;
        $this->nivelReservatorio = $nivelReservatorio;
        $this->vazao = $vazao;
        $this->potenciaGerada = $potenciaGerada;
        $this->turbinas = $turbinas;
    }

    // Retorna o nome da usina.
    public function getNomeUsina(): string
    {
        return $this->nomeUsina;
    }

    // Retorna o nível do reservatório.
    public function getNivelReservatorio(): float
    {
        return $this->nivelReservatorio;
    }

    // Classifica o nível do reservatório.
    public function verificarNivel(): string
    {
        if ($this->nivelReservatorio < 30) {
            return "NÍVEL BAIXO";
        } elseif ($this->nivelReservatorio <= 90) {
            return "NÍVEL NORMAL";
        }

        return "NÍVEL ALTO";
    }

    // Retorna a vazão de água.
    public function getVazao(): float
    {
        return $this->vazao;
    }

    // Retorna a potência gerada.
    public function getPotenciaGerada(): float
    {
        return $this->potenciaGerada;
    }

    // Retorna a quantidade de turbinas cadastradas.
    public function verificarQuantidadeTurbinas(): int
    {
        return count($this->turbinas);
    }
}