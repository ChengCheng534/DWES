<?php
    $libro = "QuijoteDeLaMancha.txt";
    $stopWorks = "stop_words.txt";
    $num;

    function dameLosQueMasAparecen($num, $libro){

        // Abrir el archivo en modo de lectura
        $fp = fopen($libro, 'r+');
        if (!$fp) {
            echo("No se pudo abrir el archivo para leer.");
        }

        // Leer y mostrar el archivo línea por línea
        while (!feof($fp)) {
            $linea = fgets($fp); // leer linea por linea el fichero
            $listasPalabra[$line]= explode(" ",$linea); 
            $palabra = [$listasPalabra];
            //$longitud = count($listasPalabra);

            print_r($palabra);
        }
        return null;
    }

    //echo dameLosQueMasAparecen($num, $libro);
    print_r(dameLosQueMasAparecen($num, $libro));
?>