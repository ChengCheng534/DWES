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

    // Función para combinar cartas de jugador con las cartas en la mesa solo si coinciden
    function coincidirMesa($cartajug, $cartaMesa) {
        // Verificar si hay alguna carta del jugador que coincida con las cartas de la mesa
        $coincidir = array_intersect($cartajug, $cartaMesa);
        if (!empty($coincidir)) {
            // Si hay coincidencia, combinar las cartas del jugador con las de la mesa
            return array_merge($cartajug, $cartaMesa);
        } else {
            // Si no hay coincidencias, el jugador se queda con sus cartas originales
            return $cartajug;
        }
    }

    // Función para contar combinaciones (parejas, tríos, póker, etc.) y devolver la puntuación
    function contarCartas($array) {
        $contador = [];
        foreach ($array as $carta) {
            if (isset($contador[$carta])) {
                $contador[$carta]++;
            } else {
                $contador[$carta] = 1;
            }
        }

        $puntuacion = 0;
        $maxCarta = max($array);
        
        foreach ($contador as $carta => $cantidad) {
            if ($cantidad == 2) {
                echo "<p>-- Pareja de carta $carta.</p>";
                $puntuacion += 2;
            } elseif ($cantidad == 3) {
                echo "<p>-- Trío de carta $carta.</p>";
                $puntuacion += 3;
            } elseif ($cantidad == 4) {
                echo "<p>-- Póker de carta $carta.</p>";
                $puntuacion += 4;
            } elseif ($cantidad == 5) {
                echo "<p>-- Repóker de carta $carta.</p>";
                $puntuacion += 5;
            }
        }
        return [$puntuacion, $maxCarta];
    }

    // Función para determinar el ganador basado en puntuación y valor de cartas
    function resultado($puntuacionJug1, $maxCartaJug1, $puntuacionJug2, $maxCartaJug2) {
        if ($puntuacionJug1 > $puntuacionJug2) {
            echo "<p>Resultado: Gana el jugador 1</p>";
        } elseif ($puntuacionJug1 < $puntuacionJug2) {
            echo "<p>Resultado: Gana el jugador 2</p>";
        } else { // Si empatan en puntuación, se desempata por la carta mayor
            if ($maxCartaJug1 > $maxCartaJug2) {
                echo "<p>Resultado: Gana el jugador 1 por carta mayor</p>";
            } elseif ($maxCartaJug1 < $maxCartaJug2) {
                echo "<p>Resultado: Gana el jugador 2 por carta mayor</p>";
            } else {
                echo "<p>Resultado: Empate.</p>";
            }
        }
    }

    echo "<h2>Partida</h2>";

    // Repartir cartas a los jugadores
    while ($jugador <= 2) {
        echo "\n<p>Jugador " . $jugador . "</p>\n";

        if ($jugador == 1) {
            for ($i = 0; $i < 2; $i++) {
                $carta = rand(1, 10);
                echo "<img src='../Tema3/cartas/c$carta.svg' alt='' width='120'>\n";
                $cartasJug1[] = $carta;
            }
        } else {
            for ($i = 0; $i < 2; $i++) {
                $carta = rand(1, 10);
                echo "<img src='../Tema3/cartas/c$carta.svg' alt='' width='120'>\n";
                $cartasJug2[] = $carta;
            }
        }
        $jugador++;
    }

    // Mostrar las cartas en la mesa
    echo "\n<p>Cartas en la mesa:</p>\n";
    for ($i = 0; $i < 3; $i++) { 
        $carta = rand(1, 10);
        echo "<img src='../Tema3/cartas/c$carta.svg' alt='' width='120'>\n";
        $cartasMesa[] = $carta;
    }

    echo "<h2>Resultado del partido: </h2>";

    // Evaluar jugador 1
    echo "<p>Cartas del jugador 1:</p>";
    $resultadoJug1 = coincidirMesa($cartasJug1, $cartasMesa);
    list($puntuacionJug1, $maxCartaJug1) = contarCartas($resultadoJug1);
    
    // Evaluar jugador 2
    echo "<p>Cartas del jugador 2:</p>";
    $resultadoJug2 = coincidirMesa($cartasJug2, $cartasMesa);
    list($puntuacionJug2, $maxCartaJug2) = contarCartas($resultadoJug2);

    // Determinar el ganador
    resultado($puntuacionJug1, $maxCartaJug1, $puntuacionJug2, $maxCartaJug2);
?>
</body>
</html>
