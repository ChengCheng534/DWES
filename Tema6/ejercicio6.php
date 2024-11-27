<?php
// Función para leer el contenido de un archivo de texto
function leerArchivo($rutaArchivo) {
    if (file_exists($rutaArchivo)) {
        return file_get_contents($rutaArchivo);
    } else {
        die("Error: El archivo no existe.");
    }
}

// Función para procesar el texto y contar la frecuencia de las palabras
function contarPalabras($texto) {
    // Convertir el texto a minúsculas y eliminar signos de puntuación
    $textoProcesado = strtolower($texto);
    $textoProcesado = preg_replace("/[^\p{L}\p{N}\s]/u", " ", $textoProcesado); // Quitar caracteres especiales

    // Dividir el texto en palabras
    $palabras = preg_split('/\s+/', $textoProcesado, -1, PREG_SPLIT_NO_EMPTY);

    // Contar las palabras en un array asociativo
    $frecuencia = array_count_values($palabras);

    // Ordenar las palabras por frecuencia en orden descendente
    arsort($frecuencia);

    return $frecuencia;
}

// Función para obtener las n palabras más frecuentes
function dameLosQueMasAparecen($frecuencia, $n) {
    return array_slice($frecuencia, 0, $n, true);
}

// Ruta del archivo de texto
$rutaArchivo = "QuijoteDeLaMancha.txt";

// Leer y procesar el archivo
$texto = leerArchivo($rutaArchivo);
$frecuenciaPalabras = contarPalabras($texto);

// Mostrar estadísticas
$n = 10; // Número de palabras más frecuentes a mostrar
$palabrasFrecuentes = dameLosQueMasAparecen($frecuenciaPalabras, $n);

echo "Las $n palabras más frecuentes son:\n";
foreach ($palabrasFrecuentes as $palabra => $frecuencia) {
    echo "$palabra: $frecuencia\n";
}
?>
