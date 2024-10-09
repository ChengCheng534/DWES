<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generar Círculos Aleatorios con PHP</title>
</head>
<body>
    <table border="1">
        <?php
            $numeroDeCirculos = rand(1, 10);
                $i = 0; 
                $radio= 50;

            do {
                $colorAleatorio = sprintf('#%06X', rand(0, 0xFFFFFF));
                echo "<tr>\n";
                echo "\t<td>\n";
                echo "\t\t<svg height='200' width='200' xmlns='http://www.w3.org/2000/svg'>\n";
                echo "\t\t\t<circle r='$radio' cx=100 cy=100 fill='$colorAleatorio' />\n";
                echo "\t\t</svg>\n";
                echo "\t</td>\n";
                echo "</tr>\n";                        

                $i++;
            } while ($i < $numeroDeCirculos);
        ?>
                
        
    </table>
</body>
</html>
