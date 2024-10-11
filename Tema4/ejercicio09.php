<?php
include 'lib_mates.php';

echo "<p>Ejercicio 9:</p>";

$base = readline("Ingresa la base: ");
$exponente = readline("Ingresa el exponente: ");

$resultado = potencia_recursiva($base, $exponente);
echo "- El resultado de $base elevado a $exponente es: $resultado\n";
?>