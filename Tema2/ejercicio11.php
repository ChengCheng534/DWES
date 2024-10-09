<?php

$edad = readline("Introducen la edad: ");
$frep = readline("Introduzca el frencuancia de reposo: ");

$fmax = 208 -(0.7*$edad);
$f70 = ($fmax-$frep)*0.7+$frep;
$f80 = ($fmax-$frep)*0.8+$frep;
$f90 = ($fmax-$frep)*0.9+$frep;

echo "***********************************";
echo "<br>";
echo "*     70%     *       $f70        *";
echo "<br>";
echo "*     70%     *       $f80        *";
echo "<br>";
echo "*     70%     *       $f90        *";
echo "<br>";
echo "***********************************";

?>