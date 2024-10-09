<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $numJugador=4;
        $jugador=1;

        while ($jugador <= 4) {
            $numCarta=1;
            $carta=rand(1,10);

            echo "<img src='cartas/c'"."$numCarta"."'.svg' alt=''>";
        $jugador++;
        }

    ?>
</body>
</html>