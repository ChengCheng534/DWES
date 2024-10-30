<?php
    $cadena1 = "1,3,5,7,9";
    $cadena2 = "2,4,6,8,10"; 

    function procesarListas($cadena1, $cadena2){
        //Convertir cadena string a numero entero
        $converEntero1 = array(explode(",", $cadena1));
        $converEntero2 = array(explode(",", $cadena2));

        //Combinar los dos arrays en una
        $combinar = array_merge($converEntero1,$converEntero2);
        return $combinar;

        //Eliminar los valores repetido de la array
        $valorRepetido = array_unique($combinar);

        //Ordenar el array
        $ordenar = sort($valorRepetido);

        return $valorRepetido;
    }

    //Convertir cadena string a numero entero
    $convertirEntero1 = explode(",", $cadena1);
    $convertirEntero2 = explode(",", $cadena2);

    echo $convertirEntero1[1];
    echo $convertirEntero2[1];

    //Combinar los dos arrays en una
    $combinar = array_merge($convertirEntero1,$convertirEntero2);

    //Eliminar los valores repetido de la array
    $valorRepetido = array_unique($combinar);

    //Ordenar el array
    sort($valorRepetido);
    foreach ($valorRepetido as $valor => $num) {
        echo $valor.",";
    }

    //Suma de array
    $suma1 = array_sum($convertirEntero1);
    $suma1 = array_sum($convertirEntero1);
    
    //Convertor array numerico al string
    $string = implode(",",$combinar);
    echo "\n".$string;

    $array = array("numeros" -> $valor, "suma"-> $suma1);
?>