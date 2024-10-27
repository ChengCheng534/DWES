<?php
function sinRepetidos($array) {
    // Creamos un array vacío donde almacenaremos los elementos sin duplicados
    $resultado = [];

    // Iteramos sobre cada elemento del array de entrada
    foreach ($array as $elemento) {
        // Bandera para verificar si el elemento ya está en el resultado
        $encontrado = false;

        // Comprobamos si el elemento ya está en el array resultado
        foreach ($resultado as $valor) {
            if ($elemento === $valor) {
                $encontrado = true;
                break;
            }
        }

        // Si el elemento no está en el array resultado, lo añadimos
        if (!$encontrado) {
            $resultado[] = $elemento;
        }
    }

    // Retornamos el array sin duplicados
    return $resultado;
}

// Ejemplo de uso
$array = [1, 2, 3, 2, 4, 1, 5, 3];
$arraySinRepetidos = sinRepetidos($array);

// Mostramos el resultado utilizando echo
echo "Array sin duplicados: [";
echo implode(", ", $arraySinRepetidos);  // Usamos implode para concatenar los elementos en una cadena
echo "]";
?>
