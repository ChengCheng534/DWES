<?php
    //Descargar el HTML de la página web
    $enlace = file_get_contents("https://www.eltiempo.es/logrono.html");

    //Limpia el contenido HTML
    $limpiarTexto = strip_tags($enlace);
    //echo $limpiarTexto;

    //Genera un número aleatorio del 0 al 6
    $num = rand(0,6);
    $diaSemanal = ["Lunes","Martes","Miercoles","Jueves","Viernes","Sabados","Domingo",];

    //Selecional dia de semana
    $selectDia = $diaSemanal[$num];
    //echo $selectDia;

    $temperatura;
    $velocidad = "velocidad";
    $viento = "viento";
    $humedad = "humedad";

    //B
    $tiempoLunes = strpos($enlace, "Lunes");
    $tiempoMartes = strpos($enlace, "Martes");
    $tiempoMiercoles = strpos($enlace, "Miércoles");
    $tiempoJueves = strpos($enlace, "Jueves");
    $tiempoViernes = strpos($enlace, "Viernes");
    $tiempoSabados = strpos($enlace, "Sábado");
    $tiempoDomingos = strpos($enlace, "Domingo");

    $tiempo[1] = substr($enlace, $tiempoLunes, 6000);
    $tiempo[2] = substr($enlace, $tiempoMartes, 6000);
    $tiempo[3] = substr($enlace, $tiempoMiercoles, 6000);
    $tiempo[4] = substr($enlace, $tiempoJueves, 6000);
    $tiempo[5] = substr($enlace, $tiempoViernes, 6000);
    $tiempo[6] = substr($enlace, $tiempoSabados, 6000);
    $tiempo[7] = substr($enlace, $tiempoDomingos, 6000);

    echo "<br>";
    print_r($tiempo[7]);

    //echo $tiempoSabados;



?>