<?php
    $array = array();
    $tamaño = 1;
    $num;

    while ($tamaño <= 9) {
        $num = readline("Introducen un número: ");
        $array += $num;
        $tamaño++;
    }
?>