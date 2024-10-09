<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        img{
            width: 30%;
        }
    </style>
</head>
<body>
    <?php
        $contador=1;
        $numCerezas=0;

        while($contador<=3){
            $fruta = rand(1,8);
            echo "<img src='frutas/".$fruta.".svg' alt=''>\n";              
            $contador++;

            if ($fruta==1) {
                $numCerezas++;
            }
        }
        echo "<hr>";
        if ($numCerezas == 1) {
            echo "<Has ganado 1 moneda por obtener una cerezas!";
        } elseif ($numCerezas == 2) {
            echo "<Has ganado 4 monedas por obtener dos cerezas";
        } elseif ($numCerezas == 3) {
            echo "Has ganado 10 monedas por obtener tres cerezas";
        } else {
            echo "<p>No has ganado nada en esta tirada.</p>\n";
        }
        echo "<hr>";
    ?>
    <a href="<?php echo $_SERVER['PHP_SELF'];?>">Moneda</a>
</body>
</html>