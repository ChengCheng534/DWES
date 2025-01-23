<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Vehículos</title>
    <link rel="stylesheet" href="estilo.css">
    <style>
        .error { color: #FF0000; }
        .content { display: none; }
        .content.active { display: block; }
    </style>
    <script>
        function showForm(formId) {
            document.querySelectorAll('.content').forEach(section => {
                section.classList.remove('active');
            });
            document.getElementById(formId).classList.add('active');
        }
    </script>
</head>
<body>
    <header>
        <h1>Gestión de Vehículos</h1>
    </header>
    <nav>
        <a href="#" onclick="showForm('alta')">Dar Alta</a>
        <a href="#" onclick="showForm('baja')">Dar Baja</a>
        <a href="#" onclick="showForm('modificacion')">Modificación</a>
        <a href="#" onclick="showForm('consulta')">Consulta por Matrícula</a>
        <a href="#" onclick="showForm('listado')">Listado de Vehículos</a>
    </nav>
    <div class="main-content">
        <?php
        require_once '../Log/Coche.php';
        require_once '../Log/CocheDAO.php';

        $cocheDao = new CocheDAO();

        // Define variables
        $matriculaErr = $marcaErr = $modeloErr = $potenciaErr = $velocidadErr = $imagenErr = "";
        $matricula = $marca = $modelo = $potencia = $velocidad = $imagen = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_alta"])) {
            // Validar matrícula
            if (empty($_POST["matricula"])) {
                $matriculaErr = "La matrícula es obligatoria.";
            } else {
                $matricula = test_input($_POST["matricula"]);
                if (!preg_match("/^[A-Z0-9]{4,10}$/", $matricula)) {
                    $matriculaErr = "Formato de matrícula no válido.";
                }
            }

            // Validar marca
            if (empty($_POST["marca"])) {
                $marcaErr = "La marca es obligatoria.";
            } else {
                $marca = test_input($_POST["marca"]);
                if (!preg_match("/^[a-zA-Z\s]{2,15}$/", $marca)) {
                    $marcaErr = "La marca solo puede contener letras y espacios.";
                }
            }

            // Validar modelo
            if (empty($_POST["modelo"])) {
                $modeloErr = "El modelo es obligatorio.";
            } else {
                $modelo = test_input($_POST["modelo"]);
                if (!preg_match("/^[a-zA-Z0-9\s\-]{2,50}$/", $modelo)) {
                    $modeloErr = "El modelo solo puede contener letras, números y guiones.";
                }
            }

            // Validar potencia
            if (empty($_POST["potencia"])) {
                $potenciaErr = "La potencia es obligatoria.";
            } else {
                $potencia = test_input($_POST["potencia"]);
                if (!preg_match("/^[1-9]{2,3}$/", $potencia)) {
                    $potenciaErr = "La potencia debe ser un número positivo.";
                }
            }

            // Validar velocidad
            if (empty($_POST["velocidad"])) {
                $velocidadErr = "La velocidad es obligatoria.";
            } else {
                $velocidad = test_input($_POST["velocidad"]);
                if (!preg_match("/^[1-9]{2,3}$/", $velocidad)) {
                    $velocidadErr = "La velocidad debe ser un número positivo.";
                }
            }

            // Validar archivo
            if (empty($_FILES["archivo"]["name"])) {
                $imagenErr = "Es obligatorio subir un archivo.";
            } else {
                $imagen = $_FILES["archivo"]["name"];
                $fileType = strtolower(pathinfo($imagen, PATHINFO_EXTENSION));
                if (!in_array($fileType, ["jpg", "jpeg", "png", "pdf"])) {
                    $imagenErr = "Solo se permiten archivos JPG, JPEG, PNG o PDF.";
                }
            }

            // Si no hay errores, registrar el coche
            if (!$matriculaErr && !$marcaErr && !$modeloErr && !$potenciaErr && !$velocidadErr && !$imagenErr) {
                // Guardamos el coche en la base de datos
                $coche = new Coche($matricula, $marca, $modelo, $potencia, $velocidad, $imagen);
                $cocheDao->darAlta($coche); // Guardamos el coche en la base de datos
            }
        }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        ?>
        <div class="content active" id="alta">
            <h2>Alta de Vehículo</h2>
            <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label for="matricula">Matrícula:</label><br>
                <input type="text" id="matricula" name="matricula" value="<?php echo $matricula; ?>" required>
                <span class="error">* <?php echo $matriculaErr; ?></span><br><br>

                <label for="marca">Marca:</label><br>
                <input type="text" id="marca" name="marca" value="<?php echo $marca; ?>" required>
                <span class="error">* <?php echo $marcaErr; ?></span><br><br>

                <label for="modelo">Modelo:</label><br>
                <input type="text" id="modelo" name="modelo" value="<?php echo $modelo; ?>" required>
                <span class="error">* <?php echo $modeloErr; ?></span><br><br>

                <label for="potencia">Potencia:</label><br>
                <input type="number" id="potencia" name="potencia" value="<?php echo $potencia; ?>" required>
                <span class="error">* <?php echo $potenciaErr; ?></span><br><br>

                <label for="velocidad">Velocidad Máxima:</label><br>
                <input type="number" id="velocidad" name="velocidad" value="<?php echo $velocidad; ?>" required>
                <span class="error">* <?php echo $velocidadErr; ?></span><br><br>

                <label for="archivo">Selecciona un archivo:</label><br>
                <input type="file" id="archivo" name="archivo" required>
                <span class="error">* <?php echo $imagenErr; ?></span><br><br>

                <br>
                <button type="submit" name="submit_alta">Registrar Vehículo</button>
            </form>
        </div>

        <div class="content" id="baja">
            <h2>Baja de Vehículo</h2>
            <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label for="matricula">Matrícula:</label><br>
                <input type="text" id="matricula" name="matricula" value="<?php echo $matricula; ?>" required>
                <span class="error">* <?php echo $matriculaErr; ?></span><br><br>

                <button type="submit" name="submit_elim">Eliminar Vehículo</button>
            </form>
        </div>

        <div class="content" id="modificacion">
            <h2>Modificación de Datos</h2>
            <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label for="matricula">Matrícula:</label><br>
                <input type="text" id="matricula" name="matricula" value="<?php echo $matricula; ?>" required>
                <span class="error">* <?php echo $matriculaErr; ?></span><br><br>

                <button type="submit" name="submit_mod">Modificar Vehículo</button>
            </form>
        </div>

        <div class="content" id="consulta">
            <h2>Consulta por Matrícula</h2>
            <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label for="matricula">Matrícula:</label><br>
                <input type="text" id="matricula" name="matricula" value="<?php echo $matricula; ?>" required>
                <span class="error">* <?php echo $matriculaErr; ?></span><br><br>

                <button type="submit" name="submit_ver">Consultar Vehículo</button>
            </form>
        </div>

        <div class="content" id="listado">
            <h2>Listado de Vehículos</h2>
            <table border="1">
                <thead>
                    <tr>
                        <th>Matrícula</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Potencia (HP)</th>
                        <th>Velocidad Máxima (km/h)</th>
                        <th>Imagen</th>
                    </tr>
                </thead>
            <tbody>
                <?php 
                    // Recorrer y mostrar la lista de coches
                    foreach ($coche as $vehiculo){
                        echo "<tr>";
                        echo "<td>" . $vehiculo->Matricula() . "</td>";
                        echo "<td>" . $vehiculo->Marca() . "</td>";
                        echo "<td>" . $vehiculo->Modelo() . "</td>";
                        echo "<td>" . $vehiculo->Potencia() . "</td>";
                        echo "<td>" . $vehiculo->Velocidad() . "</td>";
                        echo "<td><img src='../Img/" . $vehiculo->Imagen() . "' alt='Imagen del coche' width='100'></td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
    </table>
        </div>
    </div>
</body>
</html>
