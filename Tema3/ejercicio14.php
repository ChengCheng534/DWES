<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<svg width="400" height="400" viewBox="0 0 400 400" xmlns="http://www.w3.org/2000/svg">
    <?php
    $numCírculos = 10; 
    $radioInicial = 200; 
    $decremento = $radioInicial / $numCírculos; 
    $centro = 200; 

    for ($i = 0; $i < $numCírculos; $i++) {
        $radio = $radioInicial - ($i * $decremento);
        $color = ($i % 2 == 0) ? "red" : "white";

        echo "<circle cx='$centro' cy='$centro' r='$radio' fill='$color' />";
    }
    ?>
</svg>
</body>
</html>