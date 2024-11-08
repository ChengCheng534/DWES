<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Póker Simulado</title>
</head>
<body>
    <?php
    // Inicializar manos y cartas
    $cartasJug1 = [];
    $cartasJug2 = [];
    $cartasMesa = [];

    // Función para contar la cantidad de veces que aparece una carta
    function contarCartas($mano) {
        $conteo = array_count_values($mano);
        arsort($conteo); // Ordenar de mayor a menor
        return $conteo;
    }

    // Función para comprobar si hay parejas, tríos, póker y repóker considerando las cartas del jugador y la mesa
    function comprobarMano($cartasJugador, $cartasMesa) {
        // Verificar si alguna carta del jugador coincide con las de la mesa
        $coincide = array_intersect($cartasJugador, $cartasMesa);

        // Si no hay coincidencia, no se cuenta la combinación
        if (empty($coincide)) {
            return "Nada";
        }

        // Combinar las cartas del jugador con las cartas de la mesa
        $todasCartas = array_merge($cartasJugador, $cartasMesa);
        $conteo = contarCartas($todasCartas);

        // Comprobar combinaciones
        if (in_array(4, $conteo)) return "Póker";
        if (in_array(3, $conteo)) return "Trío";
        if (count(array_filter($conteo, fn($v) => $v == 2)) >= 2) return "Doble pareja";
        if (in_array(2, $conteo)) return "Pareja";
        return "Nada";
    }

    // Repartir cartas a los jugadores
    function repartirCartas(&$cartasJugador) {
        for ($i = 0; $i < 2; $i++) {
            $carta = rand(1, 10);
            echo "<img src='../../Tema3/cartas/c$carta.svg' alt='Carta jugador'>\n";
            $cartasJugador[] = $carta;
        }
    }

    // Mostrar cartas comunitarias en la mesa
    function mostrarCartasMesa(&$cartasMesa) {
        for ($i = 0; $i < 3; $i++) {
            $carta = rand(1, 10);
            echo "<img src='../../Tema3/cartas/c$carta.svg' alt='Carta mesa'>\n";
            $cartasMesa[] = $carta;
        }
    }

    // Repartir cartas a ambos jugadores
    echo "<p>Jugador 1:</p>";
    repartirCartas($cartasJug1);

    echo "<p>Jugador 2:</p>";
    repartirCartas($cartasJug2);

    // Mostrar cartas en la mesa
    echo "<p>Cartas en la mesa:</p>";
    mostrarCartasMesa($cartasMesa);

    // Comprobar manos de ambos jugadores usando las cartas de la mesa
    $resultadoJug1 = comprobarMano($cartasJug1, $cartasMesa);
    $resultadoJug2 = comprobarMano($cartasJug2, $cartasMesa);

    // Mostrar resultados
    echo "<p>Jugador 1 tiene: $resultadoJug1</p>";
    echo "<p>Jugador 2 tiene: $resultadoJug2</p>";

    // Determinar el ganador
    $valores = ["Nada" => 0, "Pareja" => 1, "Doble pareja" => 2, "Trío" => 3, "Póker" => 4];
    
    if ($valores[$resultadoJug1] > $valores[$resultadoJug2]) {
        echo "<p>Gana el Jugador 1</p>";
    } elseif ($valores[$resultadoJug1] < $valores[$resultadoJug2]) {
        echo "<p>Gana el Jugador 2</p>";
    } else {
        echo "<p>Empate</p>";
    }
    ?>
</body>
</html>
