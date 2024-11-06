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
    $jugador = 1;
    $contador = 0;
    //$cartas = array();

    while ($jugador <= 2) {
        echo "\n<p>Jugador ".$jugador."</p>\n";

        if ($jugador == 1) {
            for ($i=0; $i < 3; $i++) { 
                $carta = rand(1,10);
                echo "<img src='../Tema3/cartas/c'".$carta."'.svg' alt=''>";
                $array1[] = $carta;
            }
            $jugador++;
        }else{
            for ($i=0; $i < 3; $i++) { 
                $carta = rand(1,10);
                echo "<img src='../Tema3/cartas/".$carta.".svg' alt=''>";
                $array2[] = $carta;
            }
            $jugador++;
        }

    }
?>
</body>
</html>