<?php
    $fichero = 'tasklist.txt';
    $comando = 'tasklist';
    $proceso = "chrome.exe";
    $ficheroLog = 'ejecuciones.log';

    function AlmacenarProceso($fichero, $comando){
        // Abrir el archivo en modo escritura.
        $fp = fopen($fichero, 'w');
        if (!$fp) {
            echo ("Error: No se puede abrir el archivo '$fichero'.");
        }   

        // Bucle infinito para ejecutar el comando cada 10 segundos.
        while (true) {
            // Ejecutar el comando "tasklist".
            exec(escapeshellcmd($comando), $output, $status);
        
            if ($status) {
                echo "Error: No se pudo ejecutar el comando.";
                break;
            }
        
            // Guardar la salida en el archivo y mostrar en el navegador.
            foreach ($output as $linea) {
                fwrite($fp, $linea . PHP_EOL); // Guardar cada línea en el archivo.
            }
        
            // Mostrar en el navegador.
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
    } 

    function localizar($fichero, $nomProceso){
        $arrayPid = [];

        // Abrir el archivo en modo de lectura
        $fp = fopen($fichero, 'r+');
        if (!$fp) {
            echo "No se pudo abrir el archivo para leer.";
            return;
        }

        // Leer el archivo línea por línea
        while (!feof($fp)) {
            $linea = fgets($fp); // leo una linea
            $indice = strpos($linea, "chrome.exe");
            
            if ($indice !== false) {
                $separar = explode(" ", $linea);

                $PID = substr($linea, 29, 6);

                $arrayPid[] = $PID;
            }
        }
        // Cerrar el archivo después de leerlo
        fclose($fp);
        return $arrayPid;
    }

    //taskkill /F /pid 323  /pid 3333 /pid 654344
    function matar($array, $ficheroLog){
        $pidsEliminados = [];

        if (empty($array)) {
            echo "No hay procesos para finalizar.\n";
            return;
        }

        foreach ($array as $pid) {
            $comando = "taskkill /F /PID $pid";
            exec(escapeshellcmd($comando), $output, $status);
    
            if ($status == 0) {
                echo "Proceso con PID $pid finalizado con éxito.\n";
                $pidsEliminados[] = $pid;
            } else {
                echo "Error: No se pudo finalizar el proceso con PID $pid.\n";
            }
        }

        // Registrar en el archivo de log.
        registrarEnLog($ficheroLog, count($pidsEliminados), $pidsEliminados);
    }

    function registrarEnLog($ficheroLog, $numProcesos, $pidsEliminados) {
        $fechaHora = date("Y-m-d H:i:s");
        $usuario = getenv('USERNAME'); // Obtener el usuario del sistema en Windows.
        $listaPids = implode(", ", $pidsEliminados);
    
        // Crear la línea para el log.
        $lineaLog = "$fechaHora#$usuario#$numProcesos#$listaPids\n";
    
        // Abrir el archivo en modo de escritura o crearlo si no existe.
        $fp = fopen($ficheroLog, 'a');
        if (!$fp) {
            echo "Error: No se pudo abrir o crear el archivo de log.\n";
            return;
        }
    
        // Escribir la línea en el archivo.
        fwrite($fp, $lineaLog);
        fclose($fp);
    
        echo "Registro añadido al archivo de log: $ficheroLog\n";
    }
    
    //Almacenar el proceso en el fichero.
    //
    AlmacenarProceso($fichero, $comando);

    //Localizar los procesos del fichero.
    //print_r(localizar($fichero, $proceso));

    //Matar procesos.
    //matar(localizar($fichero, $proceso), $ficheroLog);

?>
