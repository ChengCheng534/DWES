<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    $array1 = array();
    $array2 = array();

    $num = rand (2, 7);
    $jugador = 1;
    $gana1 = 0; 
    $gana2 = 0;
    $empate = 0;

    echo "<p>Actualiza la pagina para mostrar una nueva tirada.</p>";

    while ($jugador <= 2) {
        echo "\n<p>Jugador ".$jugador."</p>\n";

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

    for ($i = 0; $i < $num; $i++) {
        if ($array1[$i] > $array2[$i]) {
            $gana1++;
        } elseif ($array2[$i] > $array1[$i]) {
            $gana2++;
        } elseif ($array2[$i] == $array1[$i]) {
            $empate++;
        }
    }
    echo "\n<p><b>Resultado</b><p>\n";
    echo "<p>El jugador 1 ha ganado ".$gana1." veces, el jugador 2 ha ganado ".$gana2." veces y los jugadores han empateado ".$empate." veces.</p>\n";
    if ($gana1 > $gana2) {
        echo "<p><b>El ganador es el Jugador 1</b> con $gana1 rondas ganadas.</p>";
    } elseif ($gana2 > $gana1) {
        echo "<p><b>El ganador es el Jugador 2</b> con $gana2 rondas ganadas.</p>";
    } else {
        echo "<p><b>Empate</b>. Ambos jugadores ganaron el mismo número de rondas.</p>";
    }
?>
</body>
</html>