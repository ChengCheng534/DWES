<?php
// Función para procesar el texto y contar la frecuencia de las palabras
function dameLosQueMasAparecen($rutaArchivo, $n) {
    $texto = '';
    
    if (file_exists($rutaArchivo)) {
        $texto = file_get_contents($rutaArchivo);
    } else {
        echo "Error: El archivo no existe.";
    }

    // Convertir el texto a minúsculas
    //$textoMinuscula = strtolower($texto);
    
    //Eliminar signos de puntuación
    $textoLimpio = preg_replace("/[^\p{L}\p{N}\s]/u", " ", $texto); // Quitar caracteres especiales

    // Dividir el texto en palabras
    $palabras = preg_split('/\s+/', $textoLimpio, -1, PREG_SPLIT_NO_EMPTY);

    // Contar las palabras en un array asociativo
    $valor = array_count_values($palabras);

    // Ordenar las palabras por frecuencia en orden descendente
    arsort($valor);

    //funcion que me devuelve la 
    return array_slice($valor, 0, $n, true);
}

function eliminarStopsWords($rutaArchivo, $rutaStop){
    //Verificar que existe el fichero de libro y si existe lo lee todos las lineas
    $textoArchivo = '';
    if (file_exists($rutaArchivo)) {
        $textoArchivo = file_get_contents($rutaArchivo);
    } else {
        echo "Error: El archivo no existe.";
    }

    //Eliminar signos de puntuación
    $textoLimpioA = preg_replace("/[^\p{L}\p{N}\s]/u", " ", $textoArchivo); // Quitar caracteres especiales

    // Dividir el texto en palabras
    $palabrasA = preg_split('/\s+/', $textoLimpioA, -1, PREG_SPLIT_NO_EMPTY);

    // Contar las palabras en un array asociativo
    $valor1 = array_count_values($palabrasA);

    ////////////////////////////////////////////////////////////////////////////////

    //Verificar que existe el fichero de stop y si existe lo lee todos las lineas
    $textoStop = '';
    if (file_exists($rutaArchivo)) {
        $textoStop = file_get_contents($rutaStop);
    } else {
        echo "Error: El archivo no existe.";
    }

    //Eliminar signos de puntuación
    $textoLimpioS = preg_replace("/[^\p{L}\p{N}\s]/u", " ", $textoStop); // Quitar caracteres especiales

    // Dividir el texto en palabras
    $palabrasS = preg_split('/\s+/', $textoLimpioS, -1, PREG_SPLIT_NO_EMPTY);

    // Contar las palabras en un array asociativo
    $valor2 = array_count_values($palabrasS);

    $eliminarStop = array_diff($valor1, $valor2);
    
    return $eliminarStop;
}


// Ruta del archivo de texto
$rutaArchivo = "QuijoteDeLaMancha.txt";
$rutaStop = "stop_words.txt";
$num = 10;

// Leer y procesar el archivo
$palabrasLibros = dameLosQueMasAparecen($rutaArchivo, $num);
//print_r($palabrasLibros);

$eliminarStopWords = eliminarStopsWords($rutaArchivo, $rutaStop);
print_r($eliminarStopWords);


?>
