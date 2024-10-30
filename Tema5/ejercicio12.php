<?php
    $array1 = array();
    $array2 = array();

    $num = rand (2, 7);
    $jugador = 1;
    $gana= 0;

    echo "<p>Actualiza la pagina para mostrar una nueva tirada.</p>\n";

    while ($jugador <= 2) {
        echo "<p>Jugador ".$jugador."</p>\n";

        if ($jugador == 1) {
            for ($i=0; $i < $num; $i++) { 
                $dado = rand(1,6);
                echo "<img src='../Tema3/dados/".$dado.".svg' alt=''>";
                $array1[] = $dado;
            }
            $jugador++;
        }else{
            for ($i=0; $i < $num; $i++) { 
                $dado = rand(1,6);
                echo "<img src='../Tema3/dados/".$dado.".svg' alt=''>";
                $array2[] = $dado;
            }
            $jugador++;
        }

    }

    echo "<p><b>Resultado</b><p>\n";
    echo "<p>Los numeros lanzado por el jugador 1: ".implode(" ",$array1)."<p>";
    echo "<p>Los numeros lanzado por el jugador 2: ".implode(" ",$array2)."<p>";
    
?>