<?php
// Nombre del archivo donde se guardará la información de "tasklist".
$fichero = 'tasklist.txt';
// Comando a ejecutar.
$comando = 'tasklist';

// Abrir el archivo en modo escritura (se sobrescribirá si existe).
$fp = fopen($fichero, 'w');
if (!$fp) {
    die("Error: No se puede abrir el archivo '$fichero'.");
}

// Bucle infinito para ejecutar el comando cada 10 segundos.
while (true) {
    // Ejecutar el comando "tasklist" y capturar la salida.
    exec(escapeshellcmd($comando), $output, $status);

    if ($status) {
        echo "Error: No se pudo ejecutar el comando.";
        break;
    }

    // Guardar la salida en el archivo y mostrar en el navegador.
    foreach ($output as $linea) {
        fwrite($fp, $linea . PHP_EOL); // Guardar cada línea en el archivo.
    }

    // Añadir separador entre ejecuciones.
    fwrite($fp, "\n--- Nueva ejecución ---\n\n");

    // Mostrar en el navegador (opcional).
    echo "<pre>";
    foreach ($output as $linea) {
        echo htmlspecialchars($linea) . "\n";
    }
    echo "</pre>";

    // Esperar 10 segundos antes de la próxima ejecución.
    sleep(10);
}

// Cerrar el archivo.
fclose($fp);
?>
