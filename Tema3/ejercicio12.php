<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Máximo valor de dados</title>
</head>
<body>
    <?php
        // Generar un número aleatorio de dados entre 1 y 10
        $numeroDados = rand(1, 10);

        // Variables para el valor máximo y su contador
        $maxValor = 0;
        $contadorMax = 0;

        // Array para almacenar los valores de los dados
        $valoresDados = [];

        echo "<h2>Se lanzaron $numeroDados dados:</h2>";

        // Lanzar los dados
        for ($i = 1; $i <= $numeroDados; $i++) {
            // Generar un número aleatorio entre 1 y 6 para cada dado
            $num = rand(1, 6);

            // Guardar el valor del dado en el array
            $valoresDados[] = $num;

            // Mostrar la imagen correspondiente del dado
            echo "<img src='dados/$num.svg' alt='Dado $num' style='width:50px;'> ";

            // Actualizar el valor máximo si es necesario
            if ($num > $maxValor) {
                $maxValor = $num;
                $contadorMax = 1; // reiniciamos el contador ya que encontramos un nuevo máximo
            } elseif ($num == $maxValor) {
                $contadorMax++; // incrementar el contador si el valor máximo aparece de nuevo
            }
        }
        echo "<p><strong>Valor máximo obtenido:</strong> $maxValor</p>";
        echo "<p><strong>El valor $maxValor se ha obtenido $contadorMax veces.</strong></p>";
    ?>
</body>
</html>
