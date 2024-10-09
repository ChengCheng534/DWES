<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<svg width="400" height="400" xmlns="http://www.w3.org/2000/svg">
    <?php
    $numCírculos = 10; 
    $radioInicial = 200; 
    $decremento = $radioInicial / $numCírculos; 
    $centro = 200; 
    $num =1;

    for ($i = 0; $i < $numCírculos; $i++) {

        $radio = $radioInicial - ($i * $decremento);
        $color = ($i % 2 == 0) ? "red" : "white";
        $numPuntuacion = 10-$i;

        echo "<circle r='$radio' cx='$centro' cy='$centro' fill='$color' />";
        echo "<text x='{$centro}' y='{$centro}' font-size='20' fill='black' 
                text-anchor='middle' dominant-baseline='middle'>";
        echo $numPuntuacion++;
        echo "</text>";
    }
    ?>
</svg>
</body>
</html>