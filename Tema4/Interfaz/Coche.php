<?php

include 'Vehiculo.php'; // Incluir la interfaz

if (!class_exists('Coche')) {
    class Coche implements Vehiculo {
        private $nivelGasolina;

        public function __construct($nivelGasolina) {
            $this->nivelGasolina = $nivelGasolina;
        }

        public function arrancar() {
            echo "El coche ha arrancado.\n";
        }

        public function detener() {
            echo "El coche se ha detenido.\n";
        }

        public function getNivelGasolina() {
            if ($this->nivelGasolina > 0) {
                $this->nivelGasolina -= 10;
            }
            return $this->nivelGasolina;
        }
    }
}
?>
