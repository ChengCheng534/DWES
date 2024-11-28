<?php
// Ruta del archivo
$archivo = "archivo.txt";

// Abrir el archivo
$handle = fopen($archivo, "r");
$palabras = [];

if ($handle) {
    while (($linea = fgets($handle)) !== false) {
        // Dividir cada línea en palabras
        $palabras_linea = preg_split('/\s+/', trim($linea));
        $palabras = array_merge($palabras, $palabras_linea);
    }
    fclose($handle);
} else {
    echo "Error al abrir el archivo.";
    
}

// Imprimir el array
print_r($palabras);
?>