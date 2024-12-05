<?php
// Nombre del archivo
$archivo = 'ejemplo.txt';

// **1. fopen()** - Abrir el archivo en modo escritura ('w')
$fp = fopen($archivo, 'w');

// **2. fputs()** - Escribir texto en el archivo
fputs($fp, "Esta es la primera línea escrita con fputs.\n");

// **3. fwrite()** - Escribir más texto en el archivo
fwrite($fp, "Esta es la segunda línea escrita con fwrite.\n");

// **4. fclose()** - Cerrar el archivo después de escribir
fclose($fp);

// **5. fopen()** - Reabrir el archivo en modo lectura ('r')
$fp = fopen($archivo, 'r');

// **6. fread()** - Leer todo el contenido del archivo
echo "Contenido completo del archivo (usando fread):\n";
echo fread($fp, filesize($archivo)) . "\n";

// Regresamos el puntero al inicio del archivo para leerlo línea por línea
rewind($fp);

// **7. fgets()** - Leer línea por línea
echo "\nContenido línea por línea (usando fgets):\n";
while (!feof($fp)) { // **8. feof()** - Comprobar si es el final del archivo
    $linea = fgets($fp);
    echo $linea;
}

// **9. fclose()** - Cerrar el archivo después de leer
fclose($fp);


/*
fopen('w'): Abre el archivo en modo de escritura, creando el archivo si no existe. Si existe, borra su contenido.
fputs(): Escribe la primera línea en el archivo.
fwrite(): Escribe la segunda línea en el archivo.
fclose(): Cierra el archivo para guardar los cambios.
fopen('r'): Reabre el archivo en modo de lectura.
fread(): Lee y muestra todo el contenido del archivo de una sola vez.
rewind(): Resetea el puntero del archivo al inicio para leerlo línea por línea.
fgets(): Lee y muestra cada línea del archivo, una por una.
feof(): Comprueba si se llegó al final del archivo durante el bucle de lectura.
fclose(): Cierra el archivo después de leer.
*/
?>
