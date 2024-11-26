<?php
    $fichero = 'tasklist.txt';
    $comando = 'tasklist';
    $proceso = "chrome.exe";

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
        // Abrir el archivo en modo de lectura
        $fp = fopen($fichero, 'r');
        if (!$fp) {
            echo "No se pudo abrir el archivo para leer.";
            return;
        }

        // Leer el archivo línea por línea
        while (!feof($fp)) {
            $linea = fgets($fp); // leo una linea
            $indice = strpos($linea, "hrome.exe");
            $arrayPid = [];
            if ($indice != false) {
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
    function matar($array){
        $matar = "taskkill /F";

        foreach ($array as $pid) {
            while($pid == true){
                exec(escapeshellcmd($matar), $output, $status);
            }
        }
 
        
    }
    
    //Almacenar el proceso en el fichero.
    //AlmacenarProceso($fichero, $comando);

    //Localizar los procesos del fichero.
    //echo localizar($fichero, $proceso);

    //Matar procesos.
    echo matar(localizar($fichero, $proceso));

?>
