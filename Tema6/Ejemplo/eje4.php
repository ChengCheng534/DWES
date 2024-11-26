<?php
// Archivo donde se almacenará el contenido del comando tasklist
$fichero = 'tasklist.txt';
// Comando de terminal para obtener los procesos
$comando = 'tasklist';

while (true) {
    // Ejecutar el comando y capturar la salida
    $output = [];
    $status = 0;
    exec(escapeshellcmd($comando), $output, $status);

    if ($status !== 0) {
        echo "Error al ejecutar el comando tasklist.\n";
        break;
    }

    // Guardar la salida en el archivo
    file_put_contents($fichero, implode(PHP_EOL, $output) . "\n--- Nueva ejecución: " . date('Y-m-d H:i:s') . "---\n");

    // Esperar 10 segundos
    sleep(10);
}


/*<-------------------------------------------------------------------------------------->*/
$tasklistFile = 'tasklist.txt';
$logFile = 'ejecuciones.log';
$processName = 'chrome.exe';

// Leer el archivo de procesos
$tasklistContent = file_get_contents($tasklistFile);
$lines = explode("\n", $tasklistContent);

$pids = [];
foreach ($lines as $line) {
    if (strpos($line, $processName) !== false) {
        // Extraer el PID de la línea (segunda columna)
        $columns = preg_split('/\s+/', $line);
        if (isset($columns[1]) && is_numeric($columns[1])) {
            $pids[] = $columns[1];
        }
    }
}

// Matar procesos y registrar los resultados
if (!empty($pids)) {
    $numProcesses = count($pids);
    $dateTime = date('Y-m-d H:i:s');
    $user = getenv('USERNAME');
    $pidsList = implode(',', $pids);

    foreach ($pids as $pid) {
        $status = 0;
        exec(escapeshellcmd("taskkill /PID $pid /F"), $output, $status);
        if ($status !== 0) {
            echo "Error al matar el proceso con PID $pid.\n";
        }
    }

    // Registrar en ejecuciones.log
    $logEntry = "$dateTime#$user#$numProcesses#$pidsList\n";
    file_put_contents($logFile, $logEntry, FILE_APPEND);
}

/*<-------------------------------------------------------------------------------------->*/
$logFile = 'ejecuciones.log';

// Solicitar al usuario el nombre y la fecha
echo "Introduce el nombre del usuario: ";
$user = trim(fgets(STDIN));

echo "Introduce la fecha (YYYY-MM-DD): ";
$date = trim(fgets(STDIN));

$totalProcesses = 0;

// Leer el archivo de log
$logContent = file_get_contents($logFile);
$lines = explode("\n", $logContent);

foreach ($lines as $line) {
    if (strpos($line, "$date#$user#") === 0) {
        $parts = explode('#', $line);
        if (isset($parts[2])) {
            $totalProcesses += (int)$parts[2];
        }
    }
}

echo "Total de procesos eliminados por $user en $date: $totalProcesses\n";

/*<-------------------------------------------------------------------------------------->*/
// Generar el mensaje de alerta
$message = "Total de procesos eliminados: $totalProcesses";
exec(escapeshellcmd("msg $user /TIME:10 $message"));

?>
