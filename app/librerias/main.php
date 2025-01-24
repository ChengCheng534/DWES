<?php
    include 'DataBase.php';
    $db = new DataBase();

    $usuarios = $db->borame();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla</title>
</head>
<body>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apelldos</th>
            <th>Fecha de Nacimiento</th>
            <th>Login</th>
            <th>Password</th>
            <th>Grupos</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($usuarios as $usuario){
                echo $usuario['nombre'].'<br>';
            }
        ?>
    </tbody>
</table>
</body>
</html>