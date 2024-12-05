<?php
// Nombre del archivo JSON desde donde leeremos los datos
$archivo = 'personas.json';

// Leer el contenido del archivo JSON
$json_str = file_get_contents($archivo);

if ($json_str === false) {
    die("No se pudo leer el archivo.");
}

// Convertir el contenido JSON en un array PHP
$personas = json_decode($json_str, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    die("Error al decodificar el JSON: " . json_last_error_msg());
}

// Mostrar los datos de cada persona
echo "Contenido del archivo JSON:\n";
foreach ($personas as $persona) {
    echo "Nombre: " . $persona['nombre'] . "\n";
    echo "Edad: " . $persona['edad'] . "\n";
    echo "Ciudad: " . $persona['ciudad'] . "\n";
    echo "-------------------\n";
}
?>
