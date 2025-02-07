<?php 
  // Cargamos el header previamente
  require RUTA_APP . '/views/inc/header.php';
?>
<a href="<?php echo RUTA_URL; ?>/clientes">Volver</a>
<h2>Agregar Cliente</h2>
<h3></h3>
<form action="<?php echo RUTA_URL; ?>/clientes/agregar" method="POST">
    <div class="form-group">
        <label for="documento_identidad"> Documento_identidad <sup>*</sup></label>
        <input type="text" name="documento_identidad" value="<?php echo $datos['documento_identidad'];?>">
        <span class="error">*<?php echo $datos['errorIdent']; ?></span>
    </div>
    <div class="form-group">
        <label for="nombre"> Nombre <sup>*</sup></label>
        <input type="text" name="nombre" value="<?php echo $datos['nombre'];?>">
        <span class="error">*<?php echo $datos['errorNombre']; ?></span>
    </div>
    <div class="form-group">
        <label for="apellidos"> Apellidos <sup>*</sup></label>
        <input type="text" name="apellidos" value="<?php echo $datos['apellidos'];?>">
        <span class="error">*<?php echo $datos['errorApellidos']; ?></span>
    </div>
    <div class="form-group">
        <label for="email"> Email <sup>*</sup></label>
        <input type="text" name="email" value="<?php echo $datos['email'];?>">
    </div>
    <div class="form-group">
        <label for="telefono"> Telefono <sup>*</sup></label>
        <input type="text" name="telefono" value="<?php echo $datos['telefono'];?>">
    </div>
    <div class="form-group">
        <label for="direccion"> Direccion <sup>*</sup></label>
        <input type="text" name="direccion" value="<?php echo $datos['direccion'];?>">
    </div>
    <div class="form-group">
        <label for="fecha_nacimiento"> Fecha_Nacimiento <sup>*</sup></label>
        <input type="date" name="fecha_nacimiento" value="<?php echo $datos['fecha_nacimiento'];?>">
    </div>
    <div class="form-group">
        <label for="fotografia"> Fotografia <sup>*</sup></label>
        <input type="file" name="fotografia" value="<?php echo $datos['fotografia'];?>">
    </div>

    <input type="submit" value="Agregar cliente">
</form>
 <?php
  // Cargamos el footer al final de la pagina
  require RUTA_APP . '/views/inc/footer.php';
?>