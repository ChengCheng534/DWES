<?php
// Nombre del archivo desde el que vamos a leer
$archivo = 'archivo.txt';

// Abrir el archivo en modo de lectura
$fp = fopen($archivo, 'r');

if (!$fp) {
    die("No se pudo abrir el archivo para leer.");
}

// Leer y mostrar el archivo línea por línea
echo "Contenido del archivo:\n";
while (($linea = fgets($fp)) !== false) {
    // Mostrar cada línea leída (ya incluye el salto de línea)
    echo $linea;
}

// Cerrar el archivo después de leer
fclose($fp);
?>
