<?php
session_start();

function verificarLogin($login){
    $fichero = "usuario.csv";

    //Abrir el fichero para leer
    $fp = fopen($fichero, 'r');
    if (!$fp) {
        echo "No se pudo abrir el archivo para leer.";
        return;
    }

    // Leer el archivo línea por línea
    while (($linea = fgets($fp)) !== false) {
        // Separar la línea por el delimitador "#"
        $separar = explode("#",  trim($linea));
        
        // Si el elemento coincide con el valor buscado
        if (trim($separar[3]) == $login) {
            fclose($fp);
            return $linea;
        }           
    }

    // Cerrar el archivo después de leerlo
    fclose($fp);
    return null;
}

function verificarPassword($contraseña, $linea){
    $fichero = "usuario.csv";

    //Abrir el fichero para leer
    $fp = fopen($fichero, 'r');
    if (!$fp) {
        echo "No se pudo abrir el archivo para leer.";
        return;
    }

    $hashEncontrada = false;
        
    $hashGuardado = trim(substr($linea, 44, $contraseña));
    if (password_verify($contraseña, $hashGuardado)) {
        
        $hashEncontrada = true;
        return true;
    }

    // Cerrar el archivo después de leerlo
    fclose($fp);
    return null;
}


$login = $password = "";
$loginErr = $passwordErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    if(!$loginErr && !$passwordErr){
     
        $linea = verificarLogin($login);
        //echo $linea;

        if(verificarLogin($login)){
            //echo verificarLogin($login);
            if(verificarPassword($password, $linea)){
                
                $_SESSION['usuario'] = $linea;
                $_SESSION['password'] = $password;
                header('Location: ejercicio6.php');

            }else{
                echo "Contraseña inválida";
            }
        }else
            echo "Login inválido.";
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
    <h2>Inicial Sección:</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
        Login: <input type="text" name="login" value="<?php echo $login;?>" require>
        <span class="error">*<?php echo $loginErr;?></span>
        <br><br>

        Password: <input type="password" name="password" value="<?php echo $password;?>" require> 
        <span class="error">*<?php echo $passwordErr;?></span>
        <br><br>

        <input type="submit" name="submit" value="Iniciar">  
    </form>
</body>
</html>