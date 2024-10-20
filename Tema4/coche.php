<?php

class Vehiculo {
    private $fechaRecogida;
    private $fechaDevolucion;

    public function __construct() {
        $this->fechaRecogida = new DateTime(); // Fecha y hora de recogida
    }

    public function devolverCoche() {
        $this->fechaDevolucion = new DateTime(); // Fecha y hora de devolución
    }

    public function getFechaRecogida() {
        return $this->fechaRecogida->format('Y-m-d H:i:s');
    }

    public function getFechaDevolucion() {
        return $this->fechaDevolucion ? $this->fechaDevolucion->format('Y-m-d H:i:s') : null;
    }
}

// Ejemplo de uso
$vehiculo = new Vehiculo();
echo "Fecha y hora de recogida: " . $vehiculo->getFechaRecogida() . "\n";

// Simulando la devolución del coche
$vehiculo->devolverCoche();
echo "Fecha y hora de devolución: " . $vehiculo->getFechaDevolucion() . "\n";

?>
