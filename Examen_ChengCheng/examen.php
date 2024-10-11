<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tablero de damas</title>
</head>
<body>
    <h1>Tablero de damas</h1>    
    <?php
        $tablero = 8;

        for ($i = 0; $i < $tablero; $i++) {
            
            $color = ($i % 2 == 0) ? 'white' : 'black';
            for ($j = 0; $j < $tablero; $j++) {
                $x1 = $j/10;
                $y1 = $i/10;
                echo "<svg width='100' height='100' xmlns='http://www.w3.org/2000/svg'>";
                echo "<rect x='$x1' y='$y1' width='100' height='100' fill='$color'/>";
                echo "</svg>";
            }
            
        } 
    ?>
</body>
</html>