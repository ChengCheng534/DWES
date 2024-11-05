<?php
$arrayTexto = ["hola", "adios", "aaaaa", "ab", "z", "caca","zulo"];

usort($arrayTexto, function($texto1, $texto2) {
    if (strlen($texto1) < strlen($texto2)) {
        return -1;
    } elseif (strlen($texto1) > strlen($texto2)) {
        return 1;
    } else {
        return strcmp($texto1, $texto2);
    }
});

print_r($arrayTexto);
//var_dump($arrayTexto);
?>
