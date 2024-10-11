<?php
header("Content-Type: image/svg+xml");

// Tamaño del tablero
$boardSize = 8;
// Tamaño de cada cuadrado
$squareSize = 50;

echo '<?xml version="1.0" encoding="UTF-8" ?>';
echo '<svg width="' . ($boardSize * $squareSize) . '" height="' . ($boardSize * $squareSize) . '" xmlns="http://www.w3.org/2000/svg">';

// Generar los rectángulos del tablero
for ($row = 0; $row < $boardSize; $row++) {
    for ($col = 0; $col < $boardSize; $col++) {
        // Calcular el color: alternar entre blanco y negro
        $color = (($row + $col) % 2 == 0) ? '#ffffff' : '#000000';
        
        // Coordenadas del rectángulo
        $x = $col * $squareSize;
        $y = $row * $squareSize;
        
        // Dibujar el rectángulo
        echo '<rect x="' . $x . '" y="' . $y . '" width="' . $squareSize . '" height="' . $squareSize . '" fill="' . $color . '" />';
    }
}

echo '</svg>';
?>
