<?php
// Matriz del juego original
$game = array(
  array('x', 'o', 'x'),
  array('o', 'x', 'o'),
  array('x', ' ', 'o')
);

// Cambiar el espacio vacío (posición [2][1]) por 'x'
$game[2][1] = 'x';
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tres en Raya</title>
  <style>
    table {
      border-collapse: collapse;
      margin: 20px auto;
    }
    td {
      width: 50px;
      height: 50px;
      text-align: center;
      font-size: 24px;
      border: 1px solid black;
    }
  </style>
</head>
<body>
  <table>
    <tr>
      <td><?php echo $game[0][0]; ?></td>
      <td><?php echo $game[0][1]; ?></td>
      <td><?php echo $game[0][2]; ?></td>
    </tr>
    <tr>
      <td><?php echo $game[1][0]; ?></td>
      <td><?php echo $game[1][1]; ?></td>
      <td><?php echo $game[1][2]; ?></td>
    </tr>
    <tr>
      <td><?php echo $game[2][0]; ?></td>
      <td><?php echo $game[2][1]; ?></td>
      <td><?php echo $game[2][2]; ?></td>
    </tr>
  </table>
</body>
</html>
