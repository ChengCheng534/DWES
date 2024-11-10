<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Póker Simulado</title>
</head>
<body>
<?php
    $cartasJug1 = array();
    $cartasJug2 = array();
    $cartasMesa = array();
    
    $jugador = 1;
    $contador = 0;

    function coincidirMesa($cartajug, $cartaMesa){
        $coincidir = array_intersect($cartajug, $cartaMesa);
        if ($coincidir == null) {
            return $cartajug;
        }else{
            $resultado = array_merge($cartajug, $cartaMesa);
            return $resultado;
        }
    }

    function contarCartas($array){
        $contador = [];
        foreach ($array as $carta) {
            if (isset($contador[$carta])) {
                $contador[$carta]++;
            } else {
                $contador[$carta] = 1;
            }
        }

        foreach ($contador as $carta => $cantidad) {
            if ($cantidad > 1) {
                echo "<p>Doble de carta $carta</p>";
            }elseif($cantidad > 2){
                echo "<p>Trío de carta $carta</p>";
            }elseif($cantidad > 3){
                echo "<p>Poker de carta $carta</p>";
            }elseif($cantidad > 4){
                echo "<p>Repoker de carta $carta</p>";
            }
        }
    }

    function resultado($cartasJug1, $cartasJug2){
        if (parejas($cartasJug1) > parejas($cartasJug2)) {
            echo "<p>Resultado: Gana el jugador 1</p>";
        }elseif(parejas($cartasJug1) < parejas($cartasJug2)){
            echo "<p>Resultado: Gana el jugador 2</p>";
        }else{
            echo "<p>Resultado: empate.</p>";
        }
    }

    echo "<h2>Partida</h2>";
    while ($jugador <= 2) {
        echo "\n<p>Jugador ".$jugador."</p>\n";

        if ($jugador == 1) {
            for ($i=0; $i < 2; $i++) { 
                $carta = rand(1,10);
                echo "<img src='../Tema3/cartas/c$carta.svg' alt='' width='120'>\n";
                $cartasJug1[] = $carta;
            }
        }else{
            for ($i=0; $i < 2; $i++) { 
                $carta = rand(1,10);
                echo "<img src='../Tema3/cartas/c$carta.svg' alt='' width='120'>\n";
                $cartasJug2[] = $carta;
            }
        }
        $jugador++;
    }
    echo "\n<p>Carta mesa:</p>\n";
    for ($i=0; $i < 3; $i++) { 
        $carta = rand(1,10);
        echo "<img src='../Tema3/cartas/c$carta.svg' alt='' width='120'>\n";
        $cartasMesa[] = $carta;
    }

    echo "<h2>Resultado del partido</h2>";
    echo "<p>Carta de jugador 1:</p>";
    $resultadoJug1 = coincidirMesa($cartasJug1, $cartasMesa);
    echo contarCartas($resultadoJug1);

    echo "<p>Carta de jugador 2:</p>";
    $resultadoJug2 = coincidirMesa($cartasJug2, $cartasMesa);
    echo contarCartas($resultadoJug2);
?>
</body>
</html>