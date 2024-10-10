<?php
require 'lib_mates.php';

// Variables para almacenar el resultado de la suma y la media
$suma = 0;
$media = 0;

// Llamada a la función con una cantidad indefinida de argumentos enteros
calcularSumaYMedia($suma, $media, 4, 5, 6, 7, 8);

// Imprimir los resultados
echo "La suma de los números es: $suma\n";
echo "La media de los números es: $media\n";
?>
