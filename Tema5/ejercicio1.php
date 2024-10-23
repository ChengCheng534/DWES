<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $dado = rand(1,6);
        $numero = array(1 => "uno", 2 => "dos", 3 => "tres", 4 => "cuatro", 5 => "cinco", 6 => "seis");
        echo "<p>Actualizce la página para mostrar un a nueva tirada.<p>";
        echo "<p><img src='../Tema3/dados/".$dado.".svg' alt=''><p>";
        echo "<p>Ha sacado un <b>". $numero[$dado].".<b><p>";
    ?>
</body>
</html>
