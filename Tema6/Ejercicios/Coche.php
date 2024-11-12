<?php
class Coche {
    private $matricula;
    private $marca;
    private $modelo;
    private $potencia;
    private $velocidadMaxima;

    // Constructor
    public function __construct($matricula, $marca, $modelo, $potencia, $velocidadMaxima) {
        $this->matricula = $matricula;
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->potencia = $potencia;
        $this->velocidadMaxima = $velocidadMaxima;
    }

    // Métodos mágicos para set/get
    public function __get($name) {
        return $this->$name;
    }

    public function __set($name, $value) {
        $this->$name = $value;
    }

    // Método toString
    public function __toString() {
        return "Matrícula: {$this->matricula}, Marca: {$this->marca}, Modelo: {$this->modelo}, Potencia: {$this->potencia} HP, Velocidad Máxima: {$this->velocidadMaxima} km/h";
    }
}
?>
