<?php
$nombre = $apellido = $fechaNac = $login = $password = "";
$nombreErr = $apellidoErr = $fechaNacErr = $loginErr = $passwordErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Empty de Nombre
    if (empty($_POST["nombre"])) {
        $nombreErr = "El nombre es requerido.";
    } else {
        $nombre = test_input($_POST["nombre"]);
        if (!preg_match("/^[A-Z]{1}[a-z]*$/",$nombre)) {
        $nombreErr = "El formato de nombre es incorrecto.";
        }
    }
    //Empty de Apellido
    if (empty($_POST["apellido"])) {
        $apellidoErr = "El apellido es requerido.";
    } else {
        $apellido = test_input($_POST["apellido"]);
        if (!preg_match("/^[A-Z]{1}[a-z]*$/",$apellido)) {
            $apellidoErr = "El formato de apellido es incorrecto.";
        }
    }

    //Empty de fecha nacimiento
    if (empty($_POST["fechaNac"])) {
        $fechaNacErr = "La fecha nacimiento es requerido.";
    } else {
        $fechaNac = test_input($_POST["fechaNac"]);
        if (!preg_match("/^\d{4}-\d{2}-\d{2}$/",$fechaNac)) {
            $fechaNacErr = "El formato de fecha es incorrecto.";
        }
    }

    //Empty de login
    if (empty($_POST["login"])) {
        $loginErr = "El login es requerido.";
    } else {
        $login = test_input($_POST["login"]);
        if (!preg_match("/^[A-Za-z]*$/",$login)) {
            $loginErr = "El formato de login es incorrecto.";
        }
    }

    //Empty de password
    if (empty($_POST["password"])) {
        $passwordErr = "El password es requerido.";
    } else {
        $password = test_input($_POST["password"]);
        if (!preg_match("/^[A-Za-z1-9]*$/",$password)) {
            $passwordErr = "El formato de password es incorrecto.";
        }
    } 


    if(!$nombreErr && !$apellidoErr && !$fechaNacErr && !$loginErr && !$passwordErr){
        $fichero = "usuario.csv";
        $fp = fopen($fichero, 'c');
        if (!$fp) {
            echo "No se pudo abrir el archivo para escribir.";
            return false;
        }

        $contrasenia = password_hash($password, PASSWORD_DEFAULT);
        echo $contrasenia;
    }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 6</title>
</head>
<body>
    <h2>Rellana el formulario:</h2>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
    Nombre: <input type="text" name="nombre" value="<?php echo $nombre;?>">
    <span class="error">* <?php echo $nombreErr;?></span>
    <br><br>

    Apellido: <input type="text" name="apellido" value="<?php echo $apellido;?>">
    <span class="error">* <?php echo $apellidoErr;?></span>
    <br><br>

    Fecha Nacimiento: <input type="date" name="fechaNac" value="<?php echo $fechaNac;?>">
    <span class="error">* <?php echo $fechaNacErr;?></span>
    <br><br>

    Login: <input type="text" name="login" value="<?php echo $login;?>">
    <span class="error">*<?php echo $loginErr;?></span>
    <br><br>

    Password: <input type="text" name="password" value="<?php echo $password;?>">
    <span class="error">*<?php echo $passwordErr;?></span>
    <br><br>

    <input type="submit" name="submit" value="Iniciar">  
</form>
</body>
</html>