<?php

    $array = array();
    $num = rand (2, 7);

    echo "<p>Actualiza la pagina para mostrar una nueva tirada.</p>\n";
    echo "<p>Tirada de ".$num." dados</p>\n";

    for ($i=0; $i < $num; $i++) { 
        $dado = rand(1,6);
        echo "<img src='../Tema3/dados/".$dado.".svg' alt=''>";
        $array[] = $dado;
    }
    $min = max($array);
    $max = max($array);

    echo "<p>Resultado<p>\n";
    echo "Los valores obtenidos son: ".implode(" ",$array);
    echo "Mayor numero de dado: ";
    echo "Menor numero de dado: ";
    
?>