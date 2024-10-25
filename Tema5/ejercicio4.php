<?php
    $longitud = 100;
    
    function rellenar($longitud){
        $resultado = [];
        $aleatorio = rand(0,1);
        $letra = array("M", "F");
        for ($i=0; $i < $longitud; $i++) { 
            $resultado[] = $letra[$aleatorio];
        }
        return $resultado;
    }

    function contar($resultado){
        $numM= 0;
        $numF= 0;
        $longitud = count($resultado);

        for ($i=0; $i < $longitud; $i++) { 
            if ($resultado[$i] === "M") {
                $numM++;
            }elseif($resultado[$i] === "F"){
                $numF++;
            }
        }

        echo "El número que hay de la letra M es:".$numM."\n";
        echo "El número que hay de la letra F es:".$numF."\n";
    }

    $llenarLetras = rellenar($longitud);
    echo "Letras aleatorias: " . implode("", $llenarLetras) . "\n";

    echo contar($llenarLetras);

?>