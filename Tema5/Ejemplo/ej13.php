<?php

// Paso 1: Descargar el contenido HTML de la página web
$html = file_get_contents("https://www.eltiempo.es/logrono.html");

if (!$html) {
    die("Error al descargar el contenido de la página.");
}

// Paso 2: Limpiar el contenido HTML descargado, dejando solo el texto
$textoLimpio = strip_tags($html);

// Mostrar el contenido limpio para depurar (opcional)
// echo $textoLimpio;

// Paso 3: Generar un número aleatorio del 0 al 6 para seleccionar un día de la semana
$diasSemana = ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"];
$diaAleatorio = rand(0, 6);
$diaSeleccionado = $diasSemana[$diaAleatorio];

// Paso 4: Extraer la información de temperatura, viento y humedad
// Aquí debes buscar una expresión regular que identifique estas secciones en el texto limpio
// (asumiendo que tienes acceso directo a esos datos en el texto).
$temperatura = "No disponible";  // Placeholder
$viento = "No disponible";       // Placeholder
$humedad = "No disponible";      // Placeholder

// Ejemplo de extracción simulada (cambia esto para adaptarlo a la estructura real)
preg_match('/Temperatura\s*:\s*(\d+)/', $textoLimpio, $tempMatch);
preg_match('/Viento\s*:\s*(\d+\s*km\/h)/', $textoLimpio, $vientoMatch);
preg_match('/Humedad\s*:\s*(\d+%)/', $textoLimpio, $humedadMatch);

if (isset($tempMatch[1])) $temperatura = $tempMatch[1] . "°C";
if (isset($vientoMatch[1])) $viento = $vientoMatch[1];
if (isset($humedadMatch[1])) $humedad = $humedadMatch[1];

// Paso 5: Mostrar el día y la información de pronóstico
echo "Día de la semana: " . $diaSeleccionado . "\n";
echo "Temperatura: " . $temperatura . "\n";
echo "Velocidad del viento: " . $viento . "\n";
echo "Humedad: " . $humedad . "\n";

?>
