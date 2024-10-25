<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Números Aleatorios</title>
    <style>
        table {
            border-collapse: collapse;
        }
        td {
            width: 30px;
            height: 30px;
            text-align: center;
            border: 1px solid black;
        }
        .max {
            background-color: red;
        }
        .min {
            background-color: green;
        }
        .media {
            background-color: yellow;
        }
        .moda {
            background-color: blue;
        }
        .mediana {
            background-color: orange;
        }
    </style>
</head>
<body>
    <?php
    // Generar un array aleatorio de 100 elementos con números entre 0 y 50
    $array = array();
    for ($i = 0; $i < 100; $i++) {
        $array[] = rand(0, 50);
    }

    // Calcular el valor máximo, mínimo, y la media
    $max = max($array);
    $min = min($array);
    $media = array_sum($array) / count($array);

    // Encontrar el valor más cercano a la media
    $valorCercanoMedia = $array[0];
    foreach ($array as $num) {
        if (abs($num - $media) < abs($valorCercanoMedia - $media)) {
            $valorCercanoMedia = $num;
        }
    }

    // Calcular la moda
    $frecuencias = array_count_values($array);
    $moda = array_keys($frecuencias, max($frecuencias))[0];

    // Calcular la mediana
    sort($array);
    $n = count($array);
    if ($n % 2 == 0) {
        $mediana = ($array[$n / 2 - 1] + $array[$n / 2]) / 2;
    } else {
        $mediana = $array[floor($n / 2)];
    }

    // Volver a recorrer el array original para mostrar en una tabla 10x10
    echo "<table>";
    for ($i = 0; $i < 10; $i++) {
        echo "<tr>";
        for ($j = 0; $j < 10; $j++) {
            $index = $i * 10 + $j;
            $value = $array[$index];

            // Determinar la clase de la celda según el valor
            if ($value == $max) {
                echo "<td class='max'>$value</td>";
            } elseif ($value == $min) {
                echo "<td class='min'>$value</td>";
            } elseif ($value == $valorCercanoMedia) {
                echo "<td class='media'>$value</td>";
            } elseif ($value == $moda) {
                echo "<td class='moda'>$value</td>";
            } elseif ($value == $mediana) {
                echo "<td class='mediana'>$value</td>";
            } else {
                echo "<td>$value</td>";
            }
        }
        echo "</tr>";
    }
    echo "</table>";
    ?>
</body>
</html>
