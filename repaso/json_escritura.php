<?php
// Lista de personas para guardar en el archivo JSON
$personas = [
    [
        "nombre" => "Juan",
        "edad" => 30,
        "ciudad" => "Madrid"
    ],
    [
        "nombre" => "Ana",
        "edad" => 25,
        "ciudad" => "Barcelona"
    ],
    [
        "nombre" => "Carlos",
        "edad" => 35,
        "ciudad" => "Sevilla"
    ]
];

// Nombre del archivo JSON donde se guardará la lista
$archivo = 'personas.json';

// Convertir el array de personas a formato JSON
$json_str = json_encode($personas, JSON_PRETTY_PRINT); // JSON_PRETTY_PRINT para formato legible

// Escribir el JSON en el archivo
if (file_put_contents($archivo, $json_str) === false) {
    die("No se pudo guardar el archivo JSON.");
}

echo "La lista de personas ha sido guardada en '$archivo'.\n";
?>
