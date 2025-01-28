<?php
// Incluimos el archivo que contiene la clase CocheDao
include_once "programa_base/cocheDao.php";
include_once "programa_base/funcionesFormulario.php";

// Creamos una instancia de CocheDao
$cocheDao = new CocheDao();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/styles.css">
    <style>
        .content {
            margin: auto;
        }
    </style>
    <title>Listado Coches</title>
</head>

<body>
    <div class="content">
        <h1>Listado de Coches</h1>
        <?php
        // Mostramos todos los coches si existen, de lo contrario mostramos un mensaje de error
        if (!$cocheDao->verTodos()) {
            echo "<h3 class='error'>No hay coches en el archivo</h3>";
            registrarError("Crítica", "No hay coches en el archivo");
        }
        ?>
    </div>
</body>

</html>