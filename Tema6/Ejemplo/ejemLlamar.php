<?php
    $fichero = 'tasklist.txt';
    $comando = 'tasklist';

    $fp = fopen($fichero, 'w');
    if (!$fp) {
        die("Error: No se puede abrir el archivo '$fichero'.");
    }

    exec(escapeshellcmd($comando), $output, $status);
    if ($status) echo "Exec comand failed";
    else{
        echo "<pre>";
        foreach ($output as $linea) echo htmlspecialchars("$linea\n");
        echo "</pre>";
    }
?>