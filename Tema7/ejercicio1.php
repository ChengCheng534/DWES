<?php
    $correo = $_GET["txtemail"];
    $edad = $_GET["txtedad"];
    if (empty($correo)) {
        echo "El campo de email es obrigatorio.";
    }elseif (empty($edad)) {
        echo "El campo de edad es obrigatorio.";
    }elseif ($edad<=0) {
        echo "El campo de edad debe ser mayor que 0.";
    }else{
        echo "<p>Tu correo electronico es: ".$correo."</p>";
        echo "<p>Tu edad es: ".$edad."<p>";
    }

?>