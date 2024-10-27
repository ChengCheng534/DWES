<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Verificar Matriz Mágica 3x3</title>
</head>
<body>

<h2>Introduce los valores de la matriz 3x3 (entre 0 y 9)</h2>
<form method="post">
    <?php
    // Crear formulario para capturar los valores de la matriz
    for ($i = 0; $i < 3; $i++) {
        for ($j = 0; $j < 3; $j++) {
            echo "<input type='number' name='matriz[$i][$j]' min='0' max='9' required> ";
        }
        echo "<br>";
    }
    ?>
    <br>
    <input type="submit" name="verificar" value="Verificar si es Matriz Mágica">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['verificar'])) {
    $matriz = $_POST['matriz'];

    // Función para verificar si la matriz es mágica
    function esMatrizMagica($matriz) {
        // Calcula la suma de la primera fila como referencia
        $sumaObjetivo = array_sum($matriz[0]);

        // Verificar cada fila
        for ($i = 0; $i < 3; $i++) {
            if (array_sum($matriz[$i]) != $sumaObjetivo) {
                return false;
            }
        }

        // Verificar cada columna
        for ($j = 0; $j < 3; $j++) {
            $sumaColumna = 0;
            for ($i = 0; $i < 3; $i++) {
                $sumaColumna += $matriz[$i][$j];
            }
            if ($sumaColumna != $sumaObjetivo) {
                return false;
            }
        }

        return true;
    }

    // Mostrar la matriz ingresada
    echo "<h3>Matriz ingresada:</h3>";
    foreach ($matriz as $fila) {
        echo implode(" ", $fila) . "<br>";
    }

    // Verificar si es una matriz mágica
    if (esMatrizMagica($matriz)) {
        echo "<p><strong>La matriz ingresada es una matriz mágica.</strong></p>";
    } else {
        echo "<p><strong>La matriz ingresada NO es una matriz mágica.</strong></p>";
    }
}
?>
</body>
</html>
