<?php


$navegacion = readline("Introduce una página: ");
switch($navegacion){
    case "Home";
        echo "Esta en Home.";
        break;
    case "About";
        echo "Esta en About.";
        break;
    case "News";
        echo "Esta en News.";
        break;
    case "Login";
        $usuario= readline("Introducen el nombre del usuario: ");
        $contraseña= readline("Introducen la contraseña del usuario: ");
        function credencial($usuario, $contraseña){
            if($usuario=="admin" && $contraseña==1234){
                return "Correcto";
            } else{
                return "Credenciales incorrectas.";
            }
        }
        echo credencial($usuario, $contraseña);
        break;
    case "Links";
        echo "Esta en Links.";
        break;
    default:
        echo "Selección no válida";
}
?>
