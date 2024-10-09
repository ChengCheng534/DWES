<?php
require 'lib_mates.php';

$numero1 = 34;
$numero2 = 2;

if (esDivisor($numero1, $numero2)) {
    echo "$numero2 es divisor de $numero1";
} else {
    echo "$numero2 no es divisor de $numero1";
}
?>
