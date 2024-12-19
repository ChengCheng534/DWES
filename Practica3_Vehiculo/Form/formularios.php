<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    .error {color: #FF0000;}
  </style>
</head>
<body> 

<?php
// define variables and set to empty values
$matricula = $marca = $modelo = $potencia = $velocidad = "";
$matriculaErr = $marcaErr = $modeloErr = $potenciaErr = $velocidadErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["matricula"])) {
    $matriculaErr = "Matricula es requerido";
  } else {
    $matricula = test_input($_POST["matricula"]);
    if (!preg_match("/^[0-9]{4}[A-Z]{3}$/",$matricula)) {
      $matriculaErr = "Matricula de coche invalida";
    }
  }
  
  if (empty($_POST["marca"])) {
    $marcaErr = "Marca es requerido";
  } else {
    $marca = test_input($_POST["marca"]);
    if (!preg_match("/^[0-9]{4}[A-Z]{3}$/",$matricula)) {
      $matriculaErr = "Matricula de coche invalida";
    }
  }
    
  if (empty($_POST["modelo"])) {
    $modeloErr = "";
  } else {
    $modelo = test_input($_POST["modelo"]);
    if (!preg_match("/\w+/",$modelo)) {
      $modeloErr = "Modelo invalido";
    }
  }

  if (empty($_POST["potencia"])) {
    $potenciaErr = "";
  } else {
    $potencia = test_input($_POST["potencia"]);
    if (!preg_match("/^[1-9]{2,3}$/", $potencia)) {
      $potenciaErr = "Potencia invalida";
    }
  }

  if (empty($_POST["velocidad"])) {
    $velocidadErr = "";
  } else {
    $velocidad = test_input($_POST["velocidad"]);
    if (!preg_match("/^[1-9]{2,3}$/", $velocidad)) {
      $velocidadErr = "Velocidad máxima invalida";
    }
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>Formulario Dar Alta Vehiculo:</h2>
<p><span class="error">* Campo requerido</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

  <label for="matricula">Matrícula: </label>
  <input type="text" name="matricula" value="<?php echo $matricula;?>">
  <span class="error">* <?php echo $matriculaErr;?></span>
  <br><br>

  <label for="marca">Marca: </label>
    <select name="operacion" id="operacion">
      <option value="vacio"></option>
      <option value="audi">Audi</option>
      <option value="bmw">BMW</option>
      <option value="mercede">Mercede</option>
      <option value="porsche">Porsche</option>
    </select>
  <span class="error">* <?php echo $marcaErr;?></span>
  <br><br>

  <label for="modelo">Modelo: </label>
    <input type="text" name="modelo" value="<?php echo $modelo;?>" require>
  <span class="error">*<?php echo $modeloErr;?></span>
  <br><br>

  <label for="potencia">Potencia: </label>
  <input type="text" name="potencia" value="<?php echo $potencia;?>" require>
  <span class="error">* <?php echo $potenciaErr;?></span>
  <br><br>

  <label for="velocidad">Velocidad Máxima:</label> 
  <input type="text" name="velocidad" value="<?php echo $velocidad;?>">
  <span class="error">* <?php echo $velocidadErr;?></span>
  <br><br>

  <label for="archivo">Selecciona un archivo:</label>
  <input type="file" name="archivo" id="archivo" required>
  <br><br>

  <input type="submit" name="submit" value="Submit">  
</form>

<?php
  echo "<h2>Datos de vehiculo:</h2>";
  echo "<br>";
  echo "<br>";
  echo "<br>";
  echo "<br>";
  echo "<br>";
  echo "<br>";
?>

</body>
</html>