<?php
    $cadena1 = "1,3,5,7,9";
    $cadena2 = "2,4,6,8,10"; 

    function procesarListas($cadena1, $cadena2){
        // Convertir cada cadena en un array de números enteros
        $convertirEntero1 = array_map('intval', explode(",", $cadena1));
        $convertirEntero2 = array_map('intval', explode(",", $cadena2));

        // Combinar los dos arrays en uno solo
        $combinar = array_merge($convertirEntero1, $convertirEntero2);

        // Eliminar valores repetidos en el array combinado
        $valorUnico = array_unique($combinar);

        // Ordenar los valores de forma ascendente
        sort($valorUnico);

        $suma = array_sum($valorUnico);
        
        // Devolver el array procesado
        return $suma;
    }

    // Llamar a la función y mostrar el resultado
    $resultado = procesarListas($cadena1, $cadena2);
    print_r($resultado);
?>
