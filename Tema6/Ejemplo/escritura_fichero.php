<?php
// Nombre del archivo donde se guardarán las líneas
$archivo = 'archivo.txt';

// Abrir el archivo en modo de escritura (si no existe, se crea)
$fp = fopen($archivo, 'w');

if (!$fp) {
    die("No se pudo abrir el archivo para escribir.");
}

// Permitir que el usuario ingrese líneas hasta que escriba "fin"
echo "Introduce líneas de texto (escribe 'fin' para terminar):\n";
while (true) {
    $linea = fgets(STDIN);  // Leer una línea desde la entrada estándar

    // Eliminar salto de línea al final de la entrada
    $linea = rtrim($linea);

    // Si el usuario escribe "fin", salimos del bucle
    if ($linea == 'fin') {
        break;
    }

    // Escribir la línea en el archivo
    fputs($fp, $linea . PHP_EOL);
}

// Cerrar el archivo después de escribir
fclose($fp);

echo "Las líneas se han guardado en '$archivo'.\n";
?>
