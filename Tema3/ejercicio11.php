<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
        $numeroDados = rand(1, 10);

        $pares = 0;
        $impares = 0;

        echo "<h2>Se lanzaron $numeroDados dados:</h2>";

        for ($i = 1; $i <= $numeroDados; $i++) {
            $num = rand(1, 6);

            echo "<img src='dados/$num.svg' alt='Dado $num' style='width:50px;'> ";

            if ($num % 2 == 0) {
                $pares++;
            } else {
                $impares++;
            }
        }
        
        echo "<p><strong>Número de valores pares:</strong> $pares</p>";
        echo "<p><strong>Número de valores impares:</strong> $impares</p>";
    ?>
</body>
</html>