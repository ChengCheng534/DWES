<?php

class Racional {
    private $numerador;
    private $denominador;

    // Constructor por defecto
    public function __construct($numerador = 0, $denominador = 1) {
        $this->numerador = $numerador;
        $this->denominador = ($denominador == 0) ? 1 : $denominador; // Evitar división por cero
    }

    // Constructor completamente parametrizado
    public static function crearRacional($numerador, $denominador) {
        return new Racional($numerador, ($denominador == 0) ? 1 : $denominador);
    }

    // Getter y Setter para numerador
    public function getNumerador() {
        return $this->numerador;
    }

    public function setNumerador($numerador) {
        $this->numerador = $numerador;
    }

    // Getter y Setter para denominador
    public function getDenominador() {
        return $this->denominador;
    }

    public function setDenominador($denominador) {
        if ($denominador != 0) {
            $this->denominador = $denominador;
        }
    }

    // Métodos de operaciones aritméticas
    public function suma(Racional $otro) {
        $numerador = $this->numerador * $otro->getDenominador() + $otro->getNumerador() * $this->denominador;
        $denominador = $this->denominador * $otro->getDenominador();
        return new Racional($numerador, $denominador);
    }

    public function resta(Racional $otro) {
        $numerador = $this->numerador * $otro->getDenominador() - $otro->getNumerador() * $this->denominador;
        $denominador = $this->denominador * $otro->getDenominador();
        return new Racional($numerador, $denominador);
    }

    public function multiplicacion(Racional $otro) {
        $numerador = $this->numerador * $otro->getNumerador();
        $denominador = $this->denominador * $otro->getDenominador();
        return new Racional($numerador, $denominador);
    }

    public function division(Racional $otro) {
        $numerador = $this->numerador * $otro->getDenominador();
        $denominador = $this->denominador * $otro->getNumerador();
        return new Racional($numerador, $denominador);
    }

    // Método de comparación
    public function esIgual(Racional $otro) {
        return ($this->numerador * $otro->getDenominador() == $otro->getNumerador() * $this->denominador);
    }

    // Método copia
    public function copia() {
        return new Racional($this->numerador, $this->denominador);
    }

    // Método setRacional
    public function setRacional($numerador, $denominador) {
        $this->numerador = $numerador;
        $this->denominador = ($denominador == 0) ? 1 : $denominador;
    }

    // Método calculaReal
    public function calculaReal() {
        return $this->numerador / $this->denominador;
    }

    // Método para mostrar el número racional
    public function mostrar() {
        echo "{$this->numerador}\n";
        echo "----------\n";
        echo "{$this->denominador}\n";
    }
}

// Ejemplo de uso
$racional1 = new Racional(3, 4);
$racional2 = new Racional(2, 5);

$suma = $racional1->suma($racional2);
$resta = $racional1->resta($racional2);
$multiplicacion = $racional1->multiplicacion($racional2);
$division = $racional1->division($racional2);

echo "Suma:\n";
$suma->mostrar();
echo "\n";

echo "Resta:\n";
$resta->mostrar();
echo "\n";

echo "Multiplicación:\n";
$multiplicacion->mostrar();
echo "\n";

echo "División:\n";
$division->mostrar();
echo "\n";

echo "¿Son iguales?: " . ($racional1->esIgual($racional2) ? "Sí" : "No") . "\n";
echo "Valor real de la primera fracción: " . $racional1->calculaReal() . "\n";
?>
