<?php

include 'Coche.php';
include 'Moto.php';

// Crear instancias
$coche = new Coche(50);
$moto = new Moto(30);

// Encender el coche
$coche->arrancar();
echo "Nivel de gasolina del coche: " . $coche->getNivelGasolina() . " unidades.\n";

// Encender la moto
$moto->arrancar();
echo "Nivel de gasolina de la moto: " . $moto->getNivelGasolina() . " unidades.\n";

// Obtener niveles de gasolina después de las invocaciones
echo "Nuevo nivel de gasolina del coche: " . $coche->getNivelGasolina() . " unidades.\n";
echo "Nuevo nivel de gasolina de la moto: " . $moto->getNivelGasolina() . " unidades.\n";

// Detener el coche
$coche->detener();

// Detener la moto
$moto->detener();

?>
