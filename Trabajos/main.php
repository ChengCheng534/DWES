<?php
// Directorio que queremos listar
$directorio = '/Program Files/Ampps/www/DWES/Tema1';


// Comprobar si el directorio existe
if (is_dir($directorio)) {
    // Obtener los archivos y carpetas del directorio
    $archivos = scandir($directorio);

    // Mostrar cada archivo o carpeta
    foreach ($archivos as $archivo) {
        // Ignorar los elementos '.' y '..'
        if ($archivo != '.' && $archivo != '..') {
            echo $archivo . "\n";
        }
    }
} else {
    echo "El directorio no existe.";
}
?>
