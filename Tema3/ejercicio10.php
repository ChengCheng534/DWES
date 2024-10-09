<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $jugador=1;
        $total=0;

        while($jugador<=2){
            $contador = 0;

            if ($jugador==1) {
                echo "<p>El jugador1:</p>";
            }else{
                echo "<p>El jugador2:</p>";
            }

            while ($contador < 2) {
                $num=rand(1,6);
                $total+= $num;
            
                echo "<img src='dados/$num.svg' alt=''>";
                
                $contador++;
            }

            if ($jugador == 1) {
                $jugador1_total = $total;
            } else {
                $jugador2_total = $total;
            }
            echo "<p>Total de suma: $total</p><hr>";
            $jugador++;
        }
        if ($jugador1_total > $jugador2_total) {
            echo "<p>HA GANADO EL JUGADOR 1 CON UN TOTAL DE $jugador1_total PUNTOS</p>";
        } elseif ($jugador2_total > $jugador1_total) {
            echo "<p>HA GANADO EL JUGADOR 2 CON UN TOTAL DE $jugador2_total PUNTOS</p>";
        } else {
            echo "<p>EMPATE CON UN TOTAL DE $jugador1_total PUNTOS</p>";
        }
    ?>
</body>
</html>