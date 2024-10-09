<?php
$a = 15;
$b = 4;
$c = 8;
$d = 20;
$e =5;

$resultado1 = ($a + $b - $c) * $d / $e % $b; 
$resultado2 = ($d - $a + $b) * ($c / $e) - $b;
$resultado3 = (($a * $b) - ($d / $e) + $c) % $b + $d;
$resultado4 = (++$a % $b + $c * $d / $e) - $a;
$resultado5 = (--$d * $b + $a - ($c % $e)) / $b;
$resultado6 = (++$a + $b * $d / $e - $c % $b) + $d;
$resultado7 = ($a + $d) * $b % $e - $c + $a;
$resultado8 = ($d - $a + $b) * ($c % $e) / $b + $a;
$resultado9 = ($c % $a) + ($b / $e) * $d - $b;
$resultado10 = (++$c * $b - $d + ($a % $e)) / $d;

//El resultado1 es 0
//El resultado2 es 10.4
//El resultado3 es -20
//El resultado4 es 21
//El resultado5 es 22
//El resultado6 es 0
//El resultado7 es 0
//El resultado8 es 0
//El resultado9 es 0
//El resultado10 es 0
?>