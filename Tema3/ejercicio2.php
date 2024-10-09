<?php

$ingreso = readline("Introducen el ingresos: ");

if ($ingreso<10000) {
    echo "El empleado no paga impuesto.";
} elseif ($ingreso>10000 && $ingreso<30000) {
    $impuesto = 0.1*$ingreso;
    echo "El empleado tiene que pagar $impuesto € de impuesto.";
} elseif ($ingreso>30000 && $ingreso<50000) {
    $impuesto = 0.2*$ingreso;
    echo "El empleado tiene que pagar $impuesto € de impuesto.";
} elseif ($ingreso>50000) {
    $impuesto = 0.3*$ingreso;
    echo "El empleado tiene que pagar $impuesto € de impuesto.";
}

?>
