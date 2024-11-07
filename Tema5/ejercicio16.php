<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    $cartasJug1 = array();
    $cartasJug2 = array();
    $cartasMesa = array();
    $jugador = 1;
    $contador = 0;
    
    function iguales($array){
        if ($array[0]===$array[1]) {
            return $array[0];
        }else{
            return 0;
        }
    }

    function parejas($array1, $array2){
        $igual = array_intersect($array1, $array2);
        return $igual;
    }


    while ($jugador <= 2) {
        echo "\n<p>Jugador ".$jugador."</p>\n";

        if ($jugador == 1) {
            for ($i=0; $i < 2; $i++) { 
                $carta = rand(1,10);
                echo "<img src='../Tema3/cartas/c$carta.svg' alt=''>\n";
                $cartasJug1[] = $carta;
            }
        }else{
            for ($i=0; $i < 2; $i++) { 
                $carta = rand(1,10);
                echo "<img src='../Tema3/cartas/c$carta.svg' alt=''>\n";
                $cartasJug2[] = $carta;
            }
        }
        $jugador++;
    }
    echo "\n<p>Carta mesa:</p>\n";
    for ($i=0; $i < 3; $i++) { 
        $carta = rand(1,10);
        echo "<img src='../Tema3/cartas/c$carta.svg' alt=''>\n";
        $cartasMesa[] = $carta;
    }

    if (iguales($cartasJug1) > iguales($cartasJug2)) {
        echo "\nGano el jugador 1";
    }elseif(iguales($cartasJug1) < iguales($cartasJug2)){
        echo "\nGano el jugador 2";
    }else{
        echo "\nEmpate";
    }
    //print_r(parejas($cartasJug1, $cartasMesa));
    //print_r(parejas($cartasJug2, $cartasMesa));
    //print_r($cartasJug2);
    echo "<br>";
    //print_r(iguales($cartasJug1));
    echo "<br>";
    //print_r(iguales($cartasJug2));
?>
</body>
</html>