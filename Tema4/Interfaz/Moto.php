<?php

include 'Vehiculo.php'; // Incluir la interfaz

if (!class_exists('Moto')) {
    class Moto implements Vehiculo {
        private $nivelGasolina;

        public function __construct($nivelGasolina) {
            $this->nivelGasolina = $nivelGasolina;
        }

        public function arrancar() {
            echo "La moto ha arrancado.\n";
        }

        public function detener() {
            echo "La moto se ha detenido.\n";
        }

        public function getNivelGasolina() {
            if ($this->nivelGasolina > 0) {
                $this->nivelGasolina -= 5;
            }
            return $this->nivelGasolina;
        }
    }
}
?>
