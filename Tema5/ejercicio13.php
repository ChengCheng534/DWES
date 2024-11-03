<?php
    //Descargar el HTML de la página web
    $enlace = file_get_contents("https://www.eltiempo.es/logrono.html");

    //Limpia el contenido HTML
    $limpiarTexto = strip_tags($enlace);
    //echo $limpiarTexto;

    //Genera un número aleatorio del 0 al 6
    $num = rand(0,6);
    $diaSemanal = ["Lunes","Martes","Miércoles","Jueves","Viernes","Sábado","Domingo"];

    //Selecional dia de semana
    $selecionarDia = $diaSemanal[$num];

    //Posiciones del dia
    $comienzo = strpos($limpiarTexto, $selecionarDia);
    $final = strpos($limpiarTexto, "%");

    //Guardar los informacion del dia en el array
    $tiempo = substr($limpiarTexto, $comienzo, $final);

    $espacio = strpos($tiempo, " ");
    $dia = substr($tiempo, 0 ,$espacio);
    
    $posiTemp = strpos($tiempo, "Sensación térmica");
    $temperatura = substr($tiempo, $posiTemp+19, 400);

    $posiViento = strpos($tiempo, "Viento");
    $velocidad = substr($tiempo, $posiViento+6, 300);

    $posHumedad = strpos($tiempo, "Humedad");
    $humedad = substr($tiempo, $posHumedad+7, 200);

    echo "Día de la semana: ".$dia;
    echo "<br>";
    echo "Temperatura: ".$temperatura;
    echo "<br>";
    echo "Velocidad del viento: ".$velocidad;
    echo "<br>";
    echo "Humedad: ".$humedad;
    echo "<br>";
    echo "<br>";
?>