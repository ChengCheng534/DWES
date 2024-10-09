<?php

$num1 = readline("Introducen el primer número: ");
$num2 = readline("Introducen el segundo número: ");
$num3 = readline("Introducen el tercer número: ");

$mayor = ($num1>$num2 && $num1>$num3) ? "El número $num1 es mayor.": 
            (($num2>$num3 && $num2>$num1) ? "El número $num2 es mayor.":
            (($num3>$num1 && $num3>$num2) ? "El número $num3 es mayor.":
            "Hay números iguales."));
echo $mayor
?>