<?php
// Incluimos los archivos necesarios
include_once "programa_base/cocheDao.php";
include_once "programa_base/funcionesFormulario.php";

// Definimos la ruta del archivo que contiene las marcas de vehículos
$archivo = './bbdd/marcas_vehiculos.txt';
if (($fp = fopen($archivo, 'r')) !== FALSE) {
    // Leemos el archivo línea por línea
    while (!feof($fp)) {
        $line = fgets($fp);
        if ($line !== FALSE) {
            // Añadimos cada línea al array de marcas, eliminando espacios en blanco
            $marcas[] = trim($line);
        }
    }
    fclose($fp);
} else {
    registrarError("Críctica", "No se pudo abrir el archivo de marcas de vehículos.");
}

// Creamos una instancia de CocheDao
$cocheDao = new CocheDao();
$matErr = $newmatErr = $marcaErr = $modeloErr = $potenciaErr = $velocidad_maximaErr = $imagenErr = $actualizarNoOk = "";
$matricula = $newmatricula = $marca = $modelo = $potencia = $velocidad_maxima = $imagen = $actualizarOk = "";
$vehiculo = null;



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['matricula'])) {
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
        registrarError("Baja", "Formato de matrícula no válido.");
    } else {
        // Buscamos el vehículo por matrícula
        $vehiculo = $cocheDao->obtenerCoche($matricula);

        if ($vehiculo != null) {
            // Si se encuentra el vehículo, asignamos sus datos a las variables
            $marca = $vehiculo->marca;
            $modelo = $vehiculo->modelo;
            $potencia = $vehiculo->potencia;
            $velocidad_maxima = $vehiculo->velocidadMaxima;
            $imagen = $vehiculo->imagen;
        } else {
            $matErr = "No se ha encontrado el vehículo con la matrícula proporcionada.";
            registrarError("Baja", $matErr);
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['actualizar'])) {
    // Validación de los datos del formulario
    if (comprobarDatos($_POST['matricula'])) {
        $newmatricula = test_input($_POST['matricula']);
    } else {
        $matErr = "Completa el campo Matricula\n";
        registrarError("Intermedia", $matErr);
    }

    if (comprobarDatos($_POST['marca'])) {
        $marca = test_input($_POST['marca']);
    } else {
        $marcaErr = "Completa el campo Marca\n";
        registrarError("Intermedia", $marcaErr);
    }

    if (comprobarDatosNoRequeridos($_POST['modelo'])) {
        $modelo = test_input($_POST['modelo']);
    } else {
        $modeloErr = "Rellena el campo modelo con un valor válido";
        registrarError("Baja", $modeloErr);
    }

    if (comprobarNumeroNoRequerido($_POST['potencia'])) {
        $potencia = test_input($_POST['potencia']);
    } else {
        $potenciaErr = "El campo Potencia debe ser un número\n";
        registrarError("Baja", $potenciaErr);
    }

    if (comprobarNumeroNoRequerido($_POST['velocidad_maxima'])) {
        $velocidad_maxima = test_input($_POST['velocidad_maxima']);
    } else {
        $velocidad_maximaErr = "El campo Velocidad Máxima debe ser un número\n";
        registrarError("Baja", $velocidad_maximaErr);
    }

    if (!validarFormatoMatricula($newmatricula)) {
        $matErr = "Formato de matrícula no válido. Ejemplo: 0000EEE";
        registrarError("Baja", "Formato de matrícula no válido.");
    }

    // Validamos la marca buscando en el array de marcas
    if (!in_array($marca, $marcas)) {
        $marcaErr = "Indica una marca del listado.";
        registrarError("Intermedia", $marcaErr);
    }

    // Verificar si se envio una imagen y si se envio correctamente
    if (isset($_FILES['imagen']) && $_FILES['imagen']['size'] != 0) {
        // Variables para el archivo
        $imagen = $_FILES['imagen'];

        // Comprobar si hubo errores al subir el archivo
        if ($imagen['error'] == UPLOAD_ERR_OK) {
            // Obtener el nombre y el tipo del archivo
            $nombreImagen = $imagen['name'];
            $tipoImagen = $imagen['type'];
            $tmpImagen = $imagen['tmp_name']; // El archivo temporal en el servidor
            $tamañoImagen = $imagen['size'];

            // Directorio donde se almacenará el archivo subido
            $directorioDestino = 'uploads/';

            // Asegurarse de que el directorio existe
            if (!is_dir($directorioDestino)) {
                mkdir($directorioDestino, 0777, true); // Crear el directorio si no existe
            }

            // Definir una ruta completa para guardar el archivo
            $rutaDestino = $directorioDestino . basename($matricula . ".jpg");

            // Verificar el tipo de archivo (por ejemplo, solo imágenes JPG y PNG)
            $tiposPermitidos = ['image/jpeg', 'image/jpg', 'image/png', 'application/webp']; // Ejemplo con imágenes y PDFs
            if (in_array($tipoImagen, $tiposPermitidos)) {
                // Verificar el tamaño máximo (por ejemplo, 2MB)
                $maxTamaño = 2 * 1024 * 1024; // 2MB en bytes
                if ($tamañoImagen <= $maxTamaño) {
                } else {
                    $imagenErr = "El archivo es demasiado grande. El tamaño máximo permitido es 2MB.";
                    registrarError("Baja", $imagenErr);
                }
            } else {
                $imagenErr = "Tipo de archivo no permitido. Solo se aceptan imágenes JPG, PNG y archivos PDF.";
                registrarError("Baja", $imagenErr);
            }
        } else {
            // Mostrar el error si hubo problemas con la subida
            $imagenErr = "Error al subir el archivo. Código de error: " . $imagen['error'];
            registrarError("Crítica", $imagenErr);
        }
    } else {
        $imagenErr = "Añade una imagen";
        registrarError("Intermedia", $imagenErr);
    }

    // Comprobación de errores en el formulario
    if (formularioErrores($matErr, $marcaErr, $modeloErr, $potenciaErr, $velocidad_maximaErr, $imagenErr)) {
        // Mover el archivo desde el temporal al directorio de destino
        if (move_uploaded_file($tmpImagen, $rutaDestino)) {
            $imagen = $rutaDestino;
        } else {
            $imagenErr = "Hubo un error al mover el archivo.";
            registrarError("Crítica", $imagenErr);
        }

        // Creamos una nueva instancia de Coche con los datos actualizados
        $nuevoCoche = new Coche($newmatricula, $marca, (string)$imagen);
        $nuevoCoche->modelo = $modelo;
        $nuevoCoche->potencia = (int)$potencia;
        $nuevoCoche->velocidadMaxima = (int)$velocidad_maxima;
        // Actualizamos el vehículo en la base de datos
        if ($cocheDao->actualizar($newmatricula, $nuevoCoche)) {
            $actualizarOk = "<h3>El vehículo ha sido actualizado correctamente.</h3>";
        } else {
            $actualizarNoOk = "<h3 class='error'>No se pudo actualizar el vehículo.</h3>";
            registrarError("Crítica", "No se pudo actualizar el vehículo.");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Vehículo</title>
    <link rel="stylesheet" href="estilos/styles.css">
</head>

<body>
    <form method="post" action="<?php echo ($_SERVER["PHP_SELF"]); ?>">
        <h1>Buscar Matricula</h1>
        <label for="matricula">Matrícula:</label>
        <input type="text" id="matricula" name="matricula" value="<?php echo $matricula; ?>" required>
        <span class="error"><?php echo $matErr; ?></span>
        <br><br>
        <input type="submit" value="Buscar">
        <br><br>
    </form>

    <?php if ($vehiculo): ?>
        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">

            <?php if ($actualizarOk): echo $actualizarOk; ?>
            <?php elseif ($actualizarNoOk): echo $actualizarNoOk; ?>
            <?php endif; ?>

            <h1>Editar Coche</h1>
            <input type="hidden" name="matricula" value="<?php echo $matricula; ?>">
            <label for="marca">Marca:</label>
            <select id="marca" name="marca">
                <?php
                foreach ($marcas as $valor) {
                    echo '<option value="' . $valor . '"';
                    if ($marca == $valor) {
                        echo ' selected';
                    }
                    echo '>' . $valor . '</option>';
                }
                ?>
            </select>
            <span class="error"><?php echo $marcaErr; ?></span>
            <br><br>
            <label for="modelo">Modelo:</label>
            <input type="text" id="modelo" name="modelo" value="<?php echo $modelo; ?>" required>
            <span class="error"><?php echo $modeloErr; ?></span>
            <br><br>
            <label for="potencia">Potencia:</label>
            <input type="text" id="potencia" name="potencia" value="<?php echo $potencia; ?>" required>
            <span class="error"><?php echo $potenciaErr; ?></span>
            <br><br>
            <label for="velocidad_maxima">Velocidad Máxima:</label>
            <input type="text" id="velocidad_maxima" name="velocidad_maxima" value="<?php echo $velocidad_maxima; ?>" required>
            <span class="error"><?php echo $velocidad_maximaErr; ?></span>
            <br><br>
            <?php if ($imagen): ?>
                <img src="<?php echo $imagen; ?>" alt="Vista previa de la imagen" width="150">
                <br><br>
            <?php endif; ?>

            <label for="imagen">Subir nueva imagen:</label>
            <input type="file" name="imagen" id="imagen">
            <span class="error"> <?php echo $imagenErr; ?></span>
            <br><br>
            <input type="submit" name="actualizar" value="Actualizar">
        </form>
    <?php endif; ?>
</body>

</html>