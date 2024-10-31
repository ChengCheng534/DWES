<?php
    $arrayTexto = ["hola", "adios", "aaaaa", "ab", "z"];

    usort($arrayTexto, function($texto1, $texto2){
        return strlen($texto1)<=>strlen($texto2);
    });

    print_r($arrayTexto);    
?>
