<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio1</title>
    
</head>
<body>
    
<?php
$numCirculos = rand(1,10);

echo "<table border=1><tr>";

$i = 0;
while ($i < $numCirculos) {
    $radio = rand(40, 80);
    $lienzo = $radio * 2;
    $color = sprintf('#%06X', rand(0, 0xFFFFFF));

    echo "<td>";
    echo "<svg height='$lienzo' width='$lienzo' xmlns='http://www.w3.org/2000/svg'>";
    echo "<circle r='$radio' cx='".($radio)."' cy='".($radio)."' fill='$color' />";
    echo "</svg>";
    echo "</td>";
$i++;
}
echo "</tr></table>";
?>

</body>
</html>