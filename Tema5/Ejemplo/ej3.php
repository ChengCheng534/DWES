<?php
// Función para generar una secuencia aleatoria de 10 bits
function generarSecuenciaBits($longitud = 10) {
    $secuencia = [];
    for ($i = 0; $i < $longitud; $i++) {
        $secuencia[] = rand(0, 1); // Genera un bit aleatorio (0 o 1)
    }
    return $secuencia;
}

// Función para detectar cambios entre bits consecutivos
function detectarCambios($secuencia) {
    $resultado = [];
    $longitud = count($secuencia);

    // Comparar cada bit con el siguiente
    for ($i = 0; $i < $longitud - 1; $i++) {
        if ($secuencia[$i] == $secuencia[$i + 1]) {
            $resultado[] = 0; // Si son iguales, el bit de resultado es 0
        } else {
            $resultado[] = 1; // Si son diferentes, el bit de resultado es 1
        }
    }

    return $resultado;
}

// Generar una secuencia aleatoria de 10 bits
$secuenciaBits = generarSecuenciaBits();

// Detectar cambios en la secuencia
$cambios = detectarCambios($secuenciaBits);

// Imprimir la secuencia original
echo "Secuencia original: " . implode("", $secuenciaBits) . "\n";

// Imprimir la secuencia de cambios
echo "Cambios detectados: " . implode("", $cambios) . "\n";
?>
