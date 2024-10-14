<?php
//EJERCICIO 2: Función esPrimo 
// Función para verificar si un número es primo
function esPrimo($numero) {
    // Un número menor que 2 no es primo
    if ($numero < 2) {
        return false;
    }

    // Verificamos si el número tiene divisores aparte de 1 y él mismo
    for ($i = 2; $i < $numero; $i++) {
        if ($numero % $i == 0) {
            return false; // Si tiene un divisor, no es primo
        }
    }
    return true; // Si no tiene divisores, es primo
}

//EJERCICIO 3: Función damePrimos
// Función para encontrar los números primos entre n1 y n2
function primosEntre($n1, $n2) {
    $resultado = "";

    // Recorremos desde n1 hasta n2
    for ($i = $n1; $i <= $n2; $i++) {
        if (esPrimo($i)) {
            // Si el número es primo, lo añadimos a la cadena
            $resultado .= $i . " ";
        }
    }
    // Quitamos el último espacio en blanco si existe
    return trim($resultado);    // Retorna la cadena con los números primos
}

//EJERCICIO 4: Función sumaPrimos
// Función que calcula la suma de los números primos en una cadena
function sumaPrimos($n1, $n2) {
    // Usamos la función primosEntre para obtener la cadena de números primos
    $cadenaPrimos = primosEntre($n1, $n2);
    $suma = 0;

    // Usamos strtok para recorrer la cadena de números separados por espacios
    $cadena = strtok($cadenaPrimos, " ");
    while ($cadena !== false) {
        $suma += (int)$cadena; // Sumamos cada número primo convertido a entero
        $cadena = strtok(" "); // Pasamos al siguiente número en la cadena
    }

    return $suma; // Retornamos la suma de los primos
}

//EJERCICIO 5: Función esDivisor
function esDivisor($numero1, $numero2) {
    if ($numero1 == 0) {
        return false;
    }
    return ($numero1 % $numero2 == 0);
}

//EJERCICIO 6: Función dameDivisores
function obtenerDivisores($numero) {
    $divisores = "";

    // Recorremos desde 1 hasta el número dado
    for ($i = 1; $i <= $numero; $i++) {
        if (esDivisor($numero, $i)) {
            $divisores .= $i . " "; // Agregamos cada divisor a la cadena
        }
    }

    return trim($divisores); // Quitamos espacios adicionales
}

//EJERCICIO 7: Argumentos indefinidos
// Función para calcular la suma y la media de una cantidad indefinida de números
function calcularSumaYMedia(&$suma, &$media, ...$numeros) {
    // Comprobar si se ha recibido al menos un número
    if (count($numeros) > 0) {
        // Calcular la suma de todos los números
        $suma = array_sum($numeros);
        // Calcular la media
        $media = $suma / count($numeros);
    } else {
        // Si no se recibieron números, suma y media son 0
        $suma = 0;
        $media = 0;
    }
}

//EJERCICIO 9: Recursividad
function potencia_recursiva($base, $exponente) {
    $resultado = 1;

    for ($i=1; $i<=$exponente; $i++){
        $resultado *= $base;
    }   

    if ($exponente == 0) {
        return 1;
    }
    return $resultado;
}

//EJERCICIO 10: Reutilización de funciones
function divisores($num) {
    $divisores = array();
    for ($i = 1; $i <= $num; $i++) {
        if ($num % $i == 0) {
            $divisores[] = $i;
        }
    }
    return $divisores;
}
// Función para mostrar los divisores primos de un número usando 'for' en lugar de 'foreach'
function divisoresPrimos($num) {
    $divisores = divisores($num); // Obtener los divisores
    $totalDivisores = count($divisores); // Contar los divisores
    
    for ($i = 0; $i < $totalDivisores; $i++) {
        if (esPrimo($divisores[$i])) {
            echo $divisores[$i] . " "; // Imprimir solo los divisores que son primos
        }
    }
}

//EJERCICIO 12: Recursividad
// Función recursiva para convertir un número decimal a binario
function decimalBinario($num){
    if ($num<2) {
        echo $num;
    } else {
        decimalBinario((int)($num/2));
        echo $num %2;
    }
}

function decimalABinario($n) {
    // Caso base: cuando n es 0, se retorna una cadena vacía
    if ($n == 0) {
        return '';
    }
    // Llamada recursiva: Dividimos el número por 2 y tomamos el resto
    return decimalABinario(intval($n / 2)) . ($n % 2);
}

//EJERCICIO 13: Creación y Uso de Objetos


//EJERCICIO 14: Clonación de Objetos


//EJERCICIO 15: Constructor y Destructor


//EJERCICIO 16: Métodos y Propiedades Estáticas


?>