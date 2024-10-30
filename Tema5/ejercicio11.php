<?php
function procesarListas($lista1, $lista2) {
    // 1. Convertir cada string en un array de números enteros
    $array1 = array_map('intval', explode(',', $lista1));
    $array2 = array_map('intval', explode(',', $lista2));
    
    // 2. Combinar ambos arrays en uno solo
    $arrayCombinado = array_merge($array1, $array2);
    
    // 3. Eliminar duplicados del array combinado
    $arrayUnico = array_unique($arrayCombinado);
    
    // 4. Ordenar el array resultante en orden ascendente
    sort($arrayUnico);
    
    // 5. Calcular la suma de los elementos únicos
    $suma = array_sum($arrayUnico);
    
    // 6. Convertir el array ordenado de números únicos a un string
    $numerosCadena = implode(',', $arrayUnico);
    
    // 7. Retornar un array asociativo con los resultados
    return [
        "números" => $numerosCadena,
        "suma" => $suma
    ];
}

$cadena1 = "1,2,3,4,5,6,7";
$cadena2 = "3,4,5,6,7,8,9"; 

$resultado = procesarListas($cadena1, $cadena2);
print_r($resultado);
//echo implode(",", $resultado);
?>
