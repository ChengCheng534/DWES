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

    $temLunes = strpos($enlace, "Lun");
    $temMartes = strpos($enlace, "Mar");
    $temMiercoles = strpos($enlace, "Lun");
    $temJueves = strpos($enlace, "Lun");
    $temViernes = strpos($enlace, "Lun");
    $temSabado = strpos($enlace, "Lun");
    $temDomingo = strpos($enlace, "Lun");

    $restTemp = substr($enlace, 156614, -157590);

    $resultado1 = substr($enlace, 160517);
    $resultado2 = substr($enlace, 161492);
    
    
    echo $resultado2;



?>