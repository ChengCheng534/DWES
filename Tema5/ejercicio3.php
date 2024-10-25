<?php
    $longitud = 10;

    echo "<center><b>CAMBIO DE BITS</b></center>\n";
    echo "Actualice la pagina mostrar una secuencia aleatoria de bits y la 
    detección de cambios de bits consecutivos en la secuencia.\n";
    
    function generarBit($longitud){
        $numbit= [];
        for ($i=0; $i < $longitud; $i++) { 
            $numbit[] = rand(0,1);
        }
        return $numbit;
    }

    function detectarCambios($numbit){
        $resultado = [];
        $longitud = count($numbit);

        for ($i=0; $i<$longitud -1 ; $i++) { 
            if ($numbit[$i] == $numbit[$i +1]) {
                $resultado[] = 0;
            }else{
                $resultado[] = 1;
            }
        }
        return $resultado;
    }

    $numeroBit = generarBit($longitud);
    $cambios = detectarCambios($numeroBit);

    echo "<p>Secuencia original: " . implode("", $numeroBit) . "</p>\n";

    echo "<p>Cambios detectados: " . implode("", $cambios) . "</p>\n";

?>