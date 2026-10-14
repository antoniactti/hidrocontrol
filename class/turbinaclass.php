<?php

// Importa a classe Operador para estabelecer
// a associação entre a turbina e seu responsável.
require_once __DIR__ . "/operadorclass.php";

// ==================================================
// CLASSE TURBINA
// Representa uma turbina monitorada pela usina.
// ==================================================

class Turbina
{
    // Atributos privados da turbina.
    private string $nomeTurbina;
    private float $temperaturaTurbina;
    private bool $estadoTurbina;
    private Operador $operadorResponsavel;

    // Inicializa os dados da turbina e seu responsável.
    public function __construct(
        string $nomeTurbina,
        float $temperaturaTurbina,
        bool $estadoTurbina,
        Operador $operadorResponsavel
    ) {
        $this->nomeTurbina = $nomeTurbina;
        $this->temperaturaTurbina = $temperaturaTurbina;
        $this->estadoTurbina = $estadoTurbina;
        $this->operadorResponsavel = $operadorResponsavel;
    }

    // Retorna o nome da turbina.
    public function getNomeTurbina(): string
    {
        return $this->nomeTurbina;
    }

    // Retorna a temperatura atual da turbina.
    public function getTemperaturaTurbina(): float
    {
        return $this->temperaturaTurbina;
    }

    // Classifica a temperatura conforme os limites definidos.
    public function verificarTemperaturaTurbina(): string
    {
        if ($this->temperaturaTurbina < 70) {
            return "NORMAL - Temperatura dentro da faixa adequada";
        } elseif ($this->temperaturaTurbina <= 85) {
            return "ATENÇÃO - Temperatura elevada";
        } else {
            return "CRÍTICA - Temperatura acima do limite recomendado. "
                . "Verifique as condições operacionais da turbina.";
        }
    }

    // Retorna o estado atual da turbina.
    public function verificarEstadoTurbina(): string
    {
        if ($this->estadoTurbina === true && $this->temperaturaTurbina < 70 && $this->temperaturaTurbina <= 85) {
            return "Ligada";
        }

        return "Desligada";
    }

    // Retorna o nome do operador responsável pela turbina.
    public function getOperadorResponsavel(): string
    {
        return $this->operadorResponsavel->getNomeOperador();
    }

    // Substitui o operador responsável pela turbina.
    public function setOperador(Operador $operadorResponsavel): void
    {
        $this->operadorResponsavel = $operadorResponsavel;
    }
}
