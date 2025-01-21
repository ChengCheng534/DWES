<?php
session_start();

function modificarDatos(){

}

function actualizar($matricula, Coche $cocheNuevo) {
    $fichero = "usuario.csv";

    $fp = fopen($this->ficheroCoche, 'r+');
    if (!$fp) {
        echo "No se pudo abrir el archivo.\n";
        return false;
    }

    $lineaEncontrada = false;
    //localizamos el coche con la matricula
    while (($linea = fgets($fp)) !== false) {
        $matriculaCoche = trim(substr($linea, 0, 10));

        if ($matriculaCoche === $matricula) {
            $lineaEncontrada = true;

            // Mover el puntero al inicio de la línea actual
            fseek($fp, -96, SEEK_CUR);

            // Campo: Marca (Inicio en posición 10, longitud 30)
            fseek($fp, 11, SEEK_CUR); // Mover al inicio del campo "marca"
            fputs($fp, str_pad(substr($cocheNuevo->marca, 0, 30), 30, " ", STR_PAD_RIGHT));

            // Campo: Modelo (Inicio en posición 40, longitud 30)
            fseek($fp, 42 - (11 + 30), SEEK_CUR); // Mover al inicio del campo "modelo"
            fputs($fp, str_pad(substr($cocheNuevo->modelo, 0, 30), 30, " ", STR_PAD_RIGHT));

            // Campo: Potencia (Inicio en posición 70, longitud 10)
            fseek($fp, 73 - (42 + 30), SEEK_CUR); // Mover al inicio del campo "potencia"
            fputs($fp, str_pad(substr($cocheNuevo->potencia, 0, 10), 10, " ", STR_PAD_RIGHT));

            // Campo: Velocidad Máxima (Inicio en posición 80, longitud 10)
            fseek($fp, 84 - (73 + 10), SEEK_CUR); // Mover al inicio del campo "velocidadMax"
            fputs($fp, str_pad(substr($cocheNuevo->velocidadMax, 0, 10), 10, " ", STR_PAD_RIGHT));

            break;
        }
    }

    // Cerrar el archivo
    fclose($fp);

    if (!$lineaEncontrada) {
        echo "--No se encontró el coche con la matrícula indicada.\n";
        return false;
    }
    return true;
}   

$nombre = $apellido = $fechaNac = $login = $password = "";
$nombreErr = $apellidoErr = $fechaNacErr = $loginErr = $passwordErr = "";

if (isset($_SESSION['usuario'])){
    $array = $_SESSION['usuario'];
    //printf($array);

    $datos = explode("#", $array);

    $nombre = $datos[0];
    $apellido = $datos[1];
    $fechaNac = $datos[2];
    $login = $datos[3];
    $password = $_SESSION['password'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Empty de Nombre
    if (empty($_POST["nombre"])) {
        $nombreErr = "El nombre es requerido.";
    } else {
        $nombre = test_input($_POST["nombre"]);
        if (!preg_match("/^[A-Z]{1}[a-z1-9]*$/",$nombre)) {
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
        if (!preg_match("/^[A-Za-z0-9]*$/",$login)) {
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

    //Crear el fichero CSV.
    if(!$nombreErr && !$apellidoErr && !$fechaNacErr && !$loginErr && !$passwordErr){

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
    <style>
        .error {color: #FF0000;}
    </style>
</head>
<body>
    <h2>Perfil personal:</h2>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
    Nombre: <input type="text" name="nombre" value="<?php echo $nombre;?>" require>
    <span class="error">* <?php echo $nombreErr;?></span>
    <br><br>

    Apellido: <input type="text" name="apellido" value="<?php echo $apellido;?>" require>
    <span class="error">* <?php echo $apellidoErr;?></span>
    <br><br>

    Fecha Nacimiento: <input type="date" name="fechaNac" value="<?php echo $fechaNac;?>" require>
    <span class="error">* <?php echo $fechaNacErr;?></span>
    <br><br>

    Login: <input type="text" name="login" value="<?php echo $login;?>" require>
    <span class="error">*<?php echo $loginErr;?></span>
    <br><br>

    Password: <input type="text" name="password" value="<?php echo $password;?>" require> 
    <span class="error">*<?php echo $passwordErr;?></span>
    <br><br>

    <input type="submit" name="submit" value="Cerrar sesión">
    <input type="submit" name="submit" value="Modificar">  
</form>
</body>
</html>