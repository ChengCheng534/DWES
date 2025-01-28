<?php
// Incluimos el archivo que contiene la clase CocheDao
include_once "programa_base/cocheDao.php";
include_once "programa_base/funcionesFormulario.php";
include_once "mail\\email.php";

// Creamos una instancia de CocheDao
$cocheDao = new CocheDao();
$elimErr = '';
$cuerpo = "Se han borrado los siguientes coches:\n";

// Comprobamos si el formulario ha sido enviado y si se han seleccionado matrículas
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['matriculas'])) {
    $matriculas = $_POST['matriculas'];

    // Eliminamos cada coche cuya matrícula ha sido seleccionada
    foreach ($matriculas as $matricula) {

        if ($cocheDao->eliminar($matricula)) {
            $cuerpo .= "$matricula\n";
        } else {
            $elimErr = "Error al eliminar el coche con matricula: $matricula";
            registrarError("Crítica", $elimErr);
            return;
        }

        // Eliminar la imagen asociada al coche utilizando un comando de CMD 
        $cmd = "del uploads\\$matricula.jpg";
        exec(escapeshellcmd($cmd), $output, $status);
        // Verificar si el comando se ejecutó correctamente
        if ($status !== 0) {
            $elimErr = "Error al eliminar la imagen de la matrícula $matricula.";
            registrarError("Crítica", $elimErr);
        }
    }

    mandarCorreo("danielalonsodaw@gmail.com", "Coches eliminados", $cuerpo);
} else {
    // Si el formulario ha sido enviado pero no se ha seleccionado ningún vehículo
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $elimErr = "No se ha seleccionado ningún vehículo para eliminar.";
        registrarError("Baja", $elimErr);
    }
}

// Mostrar la lista de coches con checkboxes
$json_archivo = file_get_contents('./bbdd/coche.json');
$coches = json_decode($json_archivo, true);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Baja de Coches</title>
    <link rel="stylesheet" href="estilos/styles.css">
    <style>
        .content {
            margin: auto;
        }
    </style>
</head>

<body>
    <div class="content">
        <h1>Baja de Coches</h1>
        <?php
        if ($json_archivo === false || $coches == null) {
            echo "<p>No se pudo leer el archivo.</p>";
            registrarError("Crítica", "No se pudo leer el archivo.");
        } else {
            echo "<form method='post' action='baja.php'>";
            echo "<ul class='car-list'>";
            foreach ($coches as $coche) {
                echo "<li class='car-item'>";
                echo "<div class='checkbox-container'>";
                echo "<input type='checkbox' name='matriculas[]' value='" . $coche['matricula'] . "'>";
                echo "<label for='matriculas[]'>Seleccionar</label>";
                echo "</div>";
                echo "<div class='car-info'>";
                echo "<h2>" . $coche['marca'] . " " . $coche['modelo'] . "</h2>";
                echo "<p><strong>Matrícula:</strong> " . $coche['matricula'] . "</p>";
                echo "<p><strong>Potencia:</strong> " . $coche['potencia'] . " CV</p>";
                echo "<p><strong>Velocidad Máxima:</strong> " . $coche['velocidadMaxima'] . " km/h</p>";
                echo "</div>";
                echo "<div class='car-image'>";
                echo "<img src='" . $coche['imagen'] . "' alt='Imagen de " . $coche['marca'] . "'>";
                echo "</div>";
                echo "</li>";
            }
            echo "</ul>";
            echo "<br><input type='submit' value='Eliminar seleccionados'>";
            echo "</form>";
        }

        // Mensaje de confirmación o error tras la eliminación
        if ($_SERVER["REQUEST_METHOD"] == "POST" && strlen($elimErr) == 0) {
            echo "<h3>Los vehículos seleccionados han sido eliminados.</h3>";
        } else {
            echo "<h3 class='error'>" . $elimErr . "</h3>";
        }
        ?>
    </div>
</body>

</html>