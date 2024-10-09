<?php
$esAdulto = true;
$tieneLicencia = false;
$esEmpleado = true;
$esEstudiante = false;
$tienePermiso = true;
$esMayoDeEdad = true;

$resultado1 = ($esAdulto && $tieneLicencia) || (!$esEstudiante && $tienePermiso);
$resultado2 = ($esEmpleado || $tieneLicencia) && ($esMayoDeEdad == $esAdulto);
$resultado3 = (!$tieneLicencia && $esAdulto) || ($esEmpleado xor $esEstudiante);
$resultado4 = ($esEstudiante != $esEmpleado) && ($tienePermiso || !$esMayoDeEdad);
$resultado5 = ($esAdulto === $esMayoDeEdad) && (!$esEmpleado || $tienePermiso && $tieneLicencia);

echo $resultado1;
echo $resultado2;
echo $resultado3;
echo $resultado4;
echo $resultado5;

var_dump($resultado1);
var_dump($resultado2);
var_dump($resultado3);
var_dump($resultado4);
var_dump($resultado5);
?>
