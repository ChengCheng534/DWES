<?php
//Ejercicio 1.
include 'lib_mates.php';

echo "\n<h3>Ejercicio 1:</h3>";
if (function_exists('esPrimo')) {
    echo "\n\t<p>- Existe este función.</p>";
}else{
    echo "\n\t<p>- No existe este función.</p>";
}

//Ejercicio 2.
$numero = 29;
echo "\n<h3>Ejercicio 2:</h3>";
if (esPrimo($numero)) {
    echo "\n\t<p>- $numero es primo.</p>";
} else {
    echo "\n\t<p>- $numero no es primo.</p>";
}

//Ejercicio 3.
echo "\n<h3>Ejercicio 3:</h3>";

$n1 = 10;
$n2 = 40;
echo "\n\t<p>- Los números primos entre $n1 y $n2 son: " . primosEntre($n1, $n2) ."</p>";

//Ejercicio 4.
echo "\n<h3>Ejercicio 4:</h3>";

$n1 = 10;
$n2 = 20;
echo "\n\t<p>- La suma de los números primos entre $n1 y $n2 es: " . sumaPrimos($n1, $n2)."</p>";

//Ejercicio 5.
echo "\n<h3>Ejercicio 5:</h3>";

$numero1 = 34;
$numero2 = 2;

if (esDivisor($numero1, $numero2)) {
    echo "\n\t<p>- $numero2 es divisor de $numero1.</p>";
} else {
    echo "\n\t<p>- $numero2 no es divisor de $numero1.</p>";
}

//Ejercicio 6.
echo "\n<h3>Ejercicio 6:</h3>";

$numero=72;
echo "\n\t<p>- Los divisores de $numero son: " . obtenerDivisores($numero). "</p>";

//Ejercicio 7.
echo "\n<h3>Ejercicio 7:</h3>";

// Variables para almacenar el resultado de la suma y la media
$suma = 0;
$media = 0;

// Llamada a la función con una cantidad indefinida de argumentos enteros
calcularSumaYMedia($suma, $media, 4, 5, 6, 7, 8);

// Imprimir los resultados
echo "\n\t<p>- La suma de los números es: $suma</p>";
echo "\n\t<p>- La media de los números es: $media</p>";

//Ejercicio 10.
echo "\n<h3>Ejercicio 10:</h3>";

$numero = 250;
echo "\n\t-";
echo divisoresPrimos($numero);

//Ejercicio 12.
echo "\n<h3>Ejercicio 12:</h3>";

// Ejemplo de uso
$n = 255; // Cambiar este número para probar con otros valores
echo "\n\t- El número binario de $n es: " . decimalABinario($n);


?>