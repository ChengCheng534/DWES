<?php
    $cadena = readline("Introducen: ");

    $patron1 = "/^[Hh]ola$/";
    $prueba1 = preg_match($patron1, $cadena);

    $patron2 = "/pepe/";
    $prueba2 = preg_match($patron2, $cadena);

    $patron3 = "/^\w+[.]\w+\.\w+$/";
    $prueba3 = preg_match($patron3, $cadena);

    $patron4 = "/^\w+[.]\w+[.][a-zA-Z]{3,3}$/";
    //$patron4 = "/^\w+\.\w+\.[a-zA-Z]{3,4}$/";
    $prueba4 =  preg_match($patron4, $cadena);

    $patron5 = "/^[0-9]{2,2}$/";
    $prueba5 = preg_match($patron5, $cadena);

    $patron6 = "/@/";
    $prueba6 = preg_match($patron6, $cadena);

    $patron7 = "/^\d{2}\s\d{2}\s\d{2}$/";
    $prueba7 = preg_match($patron7, $cadena);

    $patron8 = "/\d{2}\/\d{2}\/\d{4}/";
    $prueba8 = preg_match($patron8, $cadena);

    $patron9 = "/^[\w.-]*@\w*\..{2,3}$/";
    $prueba9 = preg_match($patron9, $cadena);

    $patron10 = "/^\d{3}[-]\d{3}[-]\d{4}$/";
    $prueba10 = preg_match($patron10, $cadena);

    echo $prueba9;
?>