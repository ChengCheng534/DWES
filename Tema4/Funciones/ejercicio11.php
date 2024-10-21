<?php
// Datos de entrada: Números que representarán las barras
$valores = [3, 6, 5, 2];  // Estos valores pueden ser reemplazados con datos del usuario

// Configuración de la gráfica
$ancho_barra = 200;  // El ancho máximo de la barra
$alto_barra = 50;    // El alto de cada barra
$espacio_entre_barras = 10;  // Espacio entre las barras

// Definir los colores de las barras
$colores = ['blue', 'yellow', 'red', 'green'];

// Iniciar el gráfico SVG
echo '<svg width="400" height="300">';

// Dibujar cada barra
for ($i = 0; $i < count($valores); $i++) {
    $longitud_barra = $valores[$i] * 30; // Multiplicamos para que la barra sea proporcional al valor
    $color_barra = $colores[$i % count($colores)]; // Asignar color cíclicamente
    
    // Dibujar el valor numérico a la izquierda de la barra
    echo '<text x="10" y="' . ($i * ($alto_barra + $espacio_entre_barras) + 35) . '" font-family="Arial" font-size="20">' . $valores[$i] . '</text>';
    
    // Dibujar la barra
    echo '<rect x="30" y="' . ($i * ($alto_barra + $espacio_entre_barras)) . '" width="' . $longitud_barra . '" height="' . $alto_barra . '" fill="' . $color_barra . '"></rect>';
}

// Finalizar el gráfico SVG
echo '</svg>';
?>
