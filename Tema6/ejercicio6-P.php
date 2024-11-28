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

function eliminarStopsWords($rutaArchivo, $stopWords){
    $leerlibro = leerArchivo($rutaArchivo);
    $leerStop = leerArchivo($stopWords);

    $arrayLibro = contarPalabras($leerlibro);
    $arrayStop = contarPalabras($leerStop);

    $eliminarStop = array_diff($arrayLibro, $arrayStop);
    
    return $eliminarStop;
}


// Ruta del archivo de texto
$rutaArchivo = "QuijoteDeLaMancha.txt";
$stopWords = "stop_words.txt";

// Leer y procesar el archivo
$texto = leerArchivo($rutaArchivo);
$palabrasLibros = contarPalabras($texto);
//print_r($palabrasLibros);

// Leer y procesar el archivo
$rutaStop = leerArchivo($stopWords);
$palabraStop = contarPalabras($rutaStop);
//print_r($palabraStop);

// Mostrar estadísticas
$n = 10;
$palabrasFrecuentes = dameLosQueMasAparecen($palabrasLibros, $n);

echo "Las $n palabras más frecuentes son:\n";
foreach ($palabrasFrecuentes as $palabra => $frecuencia) {
    echo "$palabra: $frecuencia veces\n";
}
echo "\n";
$eliminarStopWords = eliminarStopsWords($rutaArchivo, $stopWords);
print_r($eliminarStopWords);

?>
