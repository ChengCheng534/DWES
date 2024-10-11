<?php
//Ejercicio 1.
include 'lib_mates.php';

echo "<p>Ejercicio 1:</p>";
if (function_exists('esPrimo')) {
    echo "<p>- Existe este función.</p>";
}else{
    echo "<p>- No existe este función.</p>";
}

//Ejercicio 2.
$numero = 29;
echo "Ejercicio 2:";
if (esPrimo($numero)) {
    echo "<p>- $numero es primo.</p>";
} else {
    echo "<p>- $numero no es primo.</p>";
}

//Ejercicio 3.
echo "<p>Ejercicio 3:</p>";

$n1 = 10;
$n2 = 40;
echo "<p>- Los números primos entre $n1 y $n2 son: " . primosEntre($n1, $n2) ."</p>";

//Ejercicio 4.
echo "<p>Ejercicio 4:</p>";

$n1 = 10;
$n2 = 20;
echo "<p>- La suma de los números primos entre $n1 y $n2 es: " . sumaPrimos($n1, $n2)."</p>";

//Ejercicio 5.
echo "<p>Ejercicio 5:</p>";

$numero1 = 34;
$numero2 = 2;

if (esDivisor($numero1, $numero2)) {
    echo "<p>- $numero2 es divisor de $numero1.</p>";
} else {
    echo "<p>- $numero2 no es divisor de $numero1.</p>";
}

//Ejercicio 6.
echo "<p>Ejercicio 6:</p>";

$numero=72;
echo "<p>- Los divisores de $numero son: " . obtenerDivisores($numero). "</p>";

//Ejercicio 7.
echo "<h3>Ejercicio 7:</h3>";

// Variables para almacenar el resultado de la suma y la media
$suma = 0;
$media = 0;

// Llamada a la función con una cantidad indefinida de argumentos enteros
calcularSumaYMedia($suma, $media, 4, 5, 6, 7, 8);

// Imprimir los resultados
echo "<p>- La suma de los números es: $suma\n</p>";
echo "<p>- La media de los números es: $media\n</p>";

//Ejercicio 10.
echo "<p>Ejercicio 10:</p>";

$numero = 250;
echo divisoresPrimos($numero);

//Ejercicio 12.
echo "<p>Ejercicio 12:</p>";

// Ejemplo de uso
$n = 255; // Cambiar este número para probar con otros valores
echo "- El número binario de $n es: " . decimalABinario($n);
?>