<?php 
  // Cargamos el header previamente
  require RUTA_APP . '/views/inc/header.php';

//print_r($datos); // Esta variable viene del controlador
?>
<div class="container mt-5">
    <?php
        foreach ($datos['Clientes'] as $clientes) {
            echo "<ul>";
            echo "<li>".$clientes->cliente_id."</li>";
            echo "<li>".$clientes->DOCUMENTO_IDENTIDAD."</li>";
            echo "<li>".$clientes->nombre."</li>";
            echo "<li>".$clientes->apellidos."</li>";
            echo "<li>".$clientes->email."</li>";
            echo "<li>".$clientes->telefono."</li>";
            echo "<li>".$clientes->direccion."</li>";
            echo "<li>".$clientes->fecha_nacimiento."</li>";
            echo "<li>".$clientes->fotografia."</li>";
            echo "</ul>";
        }
        echo "¿Esta seguro eliminar este cliente?";
    ?>
    <br>
    <a href="<?php echo RUTA_URL . "\Clientes/borrar/$clientes->cliente_id" ?> ">Si</a>
    <br>
    <a href="<?php echo RUTA_URL; ?>/clientes">No</a>
 <?php
  // Cargamos el footer al final de la pagina
  require RUTA_APP . '/views/inc/footer.php';
?>