<?php
session_start();

$nombre = $articulo = $precio = $cantidad = "";
$nombreError = $articuloError = $precioError= $cantidadError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["nombre"])) {
        $nombreError = "Name is required";
    } else {
        $nombre = test_input($_POST["nombre"]);
        if (!preg_match("/^[a-zA-Z']*$/",$nombre)) {
          $nombreError = "Formato incorrecto";
        }
    }

    if (empty($_POST["articulo"])) {
        $articuloError = "Articulo is requerido";
    } else {
        $articulo = test_input($_POST["articulo"]);
        if (!preg_match("/^[a-zA-Z']*$/",$articulo)) {
          $articuloError = "Formato incorrecto";
        }
    }

    if (empty($_POST["precio"])) {
        $precioError = "Precio is requerido";
    } else {
        $precio = test_input($_POST["precio"]);
        if (!preg_match("/^[1-9]+[\.0-9]*$/",$precio)) {
          $precioError = "Formato incorrecto";
        }
    }

    if (empty($_POST["cantidad"])) {
        $cantidadError = "Cantidad is requerido";
    } else {
        $cantidad = test_input($_POST["cantidad"]);
        if (!preg_match("/^[1-9]+$/",$cantidad)) {
          $cantidadError = "Formato incorrecto";
        }
    }

    //comprobar error
    if (true) {
       if (isset($_SESSION['carrito'])) {
            $compra = $_SESSION ['carrito']; // Rescato lo que el carrito tiene
       }
       $compra[$articulo] = $precio . "#" . $cantidad; // Añado el nuevo articulo
       $_SESSION['carrito'] = $compra; // Lo guardo en la sesion      
        
    }

}
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra</title>
</head>
<body>
    <h1>COMPRATELO:</h1>
    
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
        <label for="cliente">Nombre: </label> 
        <input type="text" name="nombre" value="<?php echo $nombre;?>">
        <span class="error">* <?php echo $nombreError;?></span>
        <br><br>

        <label for="articulo">Articulo: </label>
        <input type="text" name="articulo" value="<?php echo $articulo;?>">
        <span class="error">* <?php echo $articuloError;?></span>
        <br><br>

        <label for="precio">Precio: </label>
        <input type="number" name="precio" value="<?php echo $precio;?>">
        <span class="error">* <?php echo $precioError;?></span>
        <br><br>

        <label for="cantidad">Cantidad: </label>
        <input type="number" name="cantidad" value="<?php echo $cantidad;?>">
        <span class="error">* <?php echo $cantidadError;?></span>
        <br><br>

        <input type="submit" name="submit" value="Añadir">  
    </form>
</body>
</html>