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
    
    function parejasJug($array){
        $vistos = [];
        $duplicados = [];

        foreach ($array as $numero) {
            if (isset($vistos[$numero])) {
                $duplicados[$numero] = true;
            } else {
                $vistos[$numero] = true;
            }
        }
        if ($duplicados == null){
            echo 0;
        }else{
            echo implode(', ', array_keys($duplicados));
        }
    }

    function coincidirMesa($cartaJug, $cartaMesa){
        $igual = array_intersect($cartaJug, $cartaMesa);
        if ($igual == null) {
            return 0;
        }else{
            $resultado = array_merge($array1, $array2);
            return $resultado;
        }
    }

    function contarCartas($array){
        $contador = [];
        foreach ($array as $numero) {
            if (isset($contador[$numero])) {
                $contador[$numero]++;
            } else {
                $contador[$numero] = 1;
            }
        }

        foreach ($contador as $numero => $cantidad) {
            if ($cantidad > 1) {
                echo "<p>El número $numero se repite $cantidad veces.</p><br>";
            }elseif($cantidad > 2){
                echo "<p>El número $numero se repite $cantidad veces.</p><br>";
            }elseif($cantidad > 3){
                echo "<p>El número $numero se repite $cantidad veces.</p><br>";
            }elseif($cantidad > 4){
                echo "<p>El número $numero se repite $cantidad veces.</p><br>";
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

    //echo parejasJug($cartasJug1);
    //echo parejasJug($cartasJug2);
    
    //$coincide =coincidirMesa($cartasJug1, $cartaMesa);
    //echo $coincide;
    //echo resultado($cartasJug1, $cartasJug2);
    //echo contarCartas(coincidirMesa($cartasJug1, $cartasMesa));
?>
</body>
</html>