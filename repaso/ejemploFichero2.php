<?php

// Nombre del archivo
$archivo = 'ejemplo_nuevo.txt';

// Verificar si el archivo existe
if (!file_exists($archivo)) {
    echo "El archivo no existe. Se creará...\n";

    // **fopen()** - Abrir archivo en modo escritura ('w'), lo creará si no existe
    $fp = fopen($archivo, 'w');

    // **fwrite()** - Escribir contenido inicial en el archivo
    fwrite($fp, "Archivo creado y contenido inicial agregado.\n");
    fwrite($fp, "Esta es la segunda línea.\n");

    // **fclose()** - Cerrar el archivo
    fclose($fp);

    echo "Archivo creado exitosamente.\n";
} else {
    echo "El archivo ya existe.\n";
}

// Reabrimos el archivo para lectura
$fp = fopen($archivo, 'r');

// Leer y mostrar contenido del archivo
echo "Contenido del archivo:\n";
while (!feof($fp)) {
    $linea = fgets($fp); // Leer línea por línea
    echo $linea;
}

// Cerrar el archivo después de leer
fclose($fp);

/*
file_exists(): Comprueba si el archivo ya existe.
Si no existe, se utiliza fopen('w') para crearlo automáticamente y permitir la escritura.
fwrite(): Escribe el contenido inicial en el archivo recién creado.
fclose(): Cierra el archivo después de escribir en él.
Si el archivo ya existe, se muestra un mensaje y se procede a leer su contenido.
fgets(): Se usa para leer línea por línea.
feof(): Verifica el final del archivo para evitar errores de lectura.
fclose(): Se cierra el archivo después de leerlo.
*/
?>
