<?php

if (!interface_exists('Vehiculo')) {
    interface Vehiculo {
        public function arrancar();
        public function detener();
        public function getNivelGasolina();
    }
}
?>


