<?php
function sinRepetidos($array) {
    $resultado = [];
    foreach ($array as $elemento) {
        $encontrado = false;
        foreach ($resultado as $valor) {
            if ($elemento === $valor) {
                $encontrado = true;
                break;
            }
        }
        if (!$encontrado) {
            $resultado[] = $elemento;
        }
    }
    return $resultado;
}

// Ordena un array de menor a mayor utilizando Bubble Sort
function ordenarArray(&$array) {
    $n = count($array);
    for ($i = 0; $i < $n - 1; $i++) {
        for ($j = 0; $j < $n - $i - 1; $j++) {
            if ($array[$j] > $array[$j + 1]) {
                // Intercambiamos los elementos si están en el orden incorrecto
                $temp = $array[$j];
                $array[$j] = $array[$j + 1];
                $array[$j + 1] = $temp;
            }
        }
    }
}

// Generamos un array con cantidad y valores aleatorios
$cantidadAleatoria = rand(5, 15);  // Cantidad aleatoria entre 5 y 15 elementos
$arrayAleatorio = [];
for ($i = 0; $i < $cantidadAleatoria; $i++) {
    $arrayAleatorio[] = rand(1, 20);  // Generamos números aleatorios entre 1 y 20
}

// Aplicamos la función sinRepetidos para eliminar duplicados
$arraySinRepetidos = sinRepetidos($arrayAleatorio);

// Ordenamos el array sin duplicados
ordenarArray($arraySinRepetidos);

// Mostramos el array original, el array sin duplicados y el array ordenado
echo "Array original con duplicados: [";
echo implode(", ", $arrayAleatorio);
echo "]\n";

echo "Array sin duplicados y ordenado: [";
echo implode(", ", $arraySinRepetidos);
echo "]";
?>
