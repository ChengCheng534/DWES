<?php
//Matriz de 3x3
$game = array(
    array('x', 'o', 'x'),
    array('o', 'x', 'o'),
    array('x', ' ', 'o')
  );

//Cambio de espacio por x
$game[2][1]= "x";


echo $game[0][0] . " | " . $game[0][1] . " | " . $game[0][2] . "\n";
echo "<br>";
echo $game[1][0] . " | " . $game[1][1] . " | " . $game[1][2] . "\n";
echo "<br>";
echo $game[2][0] . " | " . $game[2][1] . " | " . $game[2][2] . "\n";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Ejercicios 3</title>
    </head>
<body>
    <hr>
    <table border=2>
        <tr>
            <td><?php echo $game[0][0];?></td>
            <td><?php echo $game[0][1];?></td>
            <td><?php echo $game[0][2];?></td>
        </tr>
        <tr>
            <td><?php echo $game[1][0];?></td>
            <td><?php echo $game[1][1];?></td>
            <td><?php echo $game[1][2];?></td>
        </tr>
        <tr>
            <td><?php echo $game[2][0];?></td>
            <td><?php echo $game[2][1];?></td>
            <td><?php echo $game[2][2];?></td>
        </tr>
    </table>
</body>
</html>