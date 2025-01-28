<?php
// Incluimos los archivos necesarios
include_once "programa_base/cocheDao.php";
include_once "programa_base/funcionesFormulario.php";

// Definimos variables para almacenar errores y datos del formulario
$matErr = $vehiculoErr = '';
$matricula = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validación de los datos del formulario
    if (comprobarDatos($_POST['matricula'])) {
        $matricula = test_input($_POST['matricula']);
    } else {
        $matErr = "Completa el campo Matricula\n";
        registrarError("Intermedia", $matErr);
    }

    // Validamos el formato de la matrícula
    if (!validarFormatoMatricula($matricula)) {
        $matErr = "Formato de matrícula no válido. Ejemplo: 0000EEE";
        registrarError("Baja", $matErr);
    }

    // Creamos una instancia de CocheDao y buscamos el vehículo por matrícula
    $cocheDao = new CocheDao();
    $vehiculo = $cocheDao->obtenerCoche($matricula);
    if ($vehiculo == null) {
        $vehiculoErr = "No se ha encontrado el vehículo con la matrícula proporcionada.";
        registrarError("Baja", $vehiculoErr);
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Consulta por matrícula</title>
    <link rel="stylesheet" href="estilos/styles.css">
    <style>
        .content {
            margin: auto;
        }
    </style>
</head>

<body>
    <div class="content">
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <h1>Consulta por matrícula</h1>
            <label for="matricula">Matrícula:</label>
            <input type="text" id="matricula" name="matricula" value="<?php echo $matricula; ?>" required>
            <span class="error"><?php echo $matErr; ?></span>
            <br><br>
            <input type="submit" value="Enviar">
        </form>

        <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && strlen($vehiculoErr) == 0): ?>
            <ul class="car-list">
                <h2>Datos del Vehículo</h2>
                <li class="car-item">
                    <div class="car-info">
                        <h2><?php echo $vehiculo->marca . " " . $vehiculo->modelo; ?></h2>
                        <p><strong>Matrícula:</strong> <?php echo $vehiculo->matricula; ?></p>
                        <p><strong>Potencia:</strong> <?php echo $vehiculo->potencia; ?> CV</p>
                        <p><strong>Velocidad Máxima:</strong> <?php echo $vehiculo->velocidadMaxima; ?> km/h</p>
                    </div>
                    <div class="car-image">
                        <img src="<?php echo $vehiculo->imagen; ?>" alt="Imagen de <?php echo $vehiculo->marca; ?>">
                    </div>
                </li>
            </ul>
        <?php elseif ($_SERVER["REQUEST_METHOD"] == "POST" && strlen($vehiculoErr) > 0 && strlen($matErr) == 0): ?>
            <p class="error"><?php echo $vehiculoErr; ?></p>
        <?php endif; ?>
    </div>
</body>

</html>