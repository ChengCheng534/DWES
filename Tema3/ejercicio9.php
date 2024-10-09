<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table border="1">
        <?php
            $circulo= rand(1,10);
            $radio = 50;
            $xPos = 100;

            for ($i = 0; $i < $circulo; $i++) {
                $colorAleatorio = sprintf('#%06X', rand(0, 0xFFFFFF));
                $num=rand(1,9);
                $rotacionAleatoria = rand(-80, 80);

                echo "<td>";
                echo "<svg height='200' width='200' xmlns='http://www.w3.org/2000/svg'>";
                echo "<circle r='$radio' cx='$xPos' cy=100 fill='$colorAleatorio' />";
                echo "<text x='{$xPos}' y='100' font-size='20' fill='black' 
                text-anchor='middle' dominant-baseline='middle' 
                transform='rotate({$rotacionAleatoria}, {$xPos}, 100)'>";
                echo $num;
                echo "</text>";
                echo "</svg>";
                echo "</td>"; 
            }
        ?>
    </table>
</body>
</html>