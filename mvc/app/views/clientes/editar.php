<?php 
  // Cargamos el header previamente
  require RUTA_APP . '/views/inc/header.php';
?>
<a href="<?php echo RUTA_URL; ?>/clientes">Volver</a>
<h2>Actualizar Cliente</h2>
<h3></h3>
<form action="<?php echo RUTA_URL; ?>/clientes/editar" method="POST">
    <div class="form-group">
        <label for="cliente_id"> Cliente_id</label>
        <input type="text" value="<?php foreach ($datos['Clientes'] as $clientes) { echo $clientes->cliente_id; }?>" class="field left" readonly>
    </div>
    <div class="form-group">
        <label for="documento_identidad"> Documento_identidad <sup>*</sup></label>
        <input type="text" name="documento_identidad" value="<?php foreach ($datos['Clientes'] as $clientes) { echo $clientes->DOCUMENTO_IDENTIDAD; } ?>">
        <span class="error">*</span>
    </div>
    <div class="form-group">
        <label for="nombre"> Nombre <sup>*</sup></label>
        <input type="text" name="nombre" value="<?php foreach ($datos['Clientes'] as $clientes) { echo $clientes->nombre; } ?>">
        <span class="error">*</span>
    </div>
    <div class="form-group">
        <label for="apellidos"> Apellidos <sup>*</sup></label>
        <input type="text" name="apellidos" value="<?php foreach ($datos['Clientes'] as $clientes) { echo $clientes->apellidos; } ?>">
        <span class="error">*</span>
    </div>
    <div class="form-group">
        <label for="email"> Email <sup>*</sup></label>
        <input type="text" name="email" value="<?php foreach ($datos['Clientes'] as $clientes) { echo $clientes->email; } ?>">
    </div>
    <div class="form-group">
        <label for="telefono"> Telefono <sup>*</sup></label>
        <input type="text" name="telefono" value="<?php foreach ($datos['Clientes'] as $clientes) { echo $clientes->telefono; } ?>">
    </div>
    <div class="form-group">
        <label for="direccion"> Direccion <sup>*</sup></label>
        <input type="text" name="direccion" value="<?php foreach ($datos['Clientes'] as $clientes) { echo $clientes->direccion; } ?>">
    </div>
    <div class="form-group">
        <label for="fecha_nacimiento"> Fecha_Nacimiento <sup>*</sup></label>
        <input type="date" name="fecha_nacimiento" value="<?php foreach ($datos['Clientes'] as $clientes) { echo $clientes->fecha_nacimiento; } ?>">
    </div>
    <div class="form-group">
        <label for="fotografia"> Fotografia <sup>*</sup></label>
        <input type="file" name="fotografia" value="<?php foreach ($datos['Clientes'] as $clientes) { echo $clientes->fotografia; } ?>">
    </div>

    <input type="submit" value="Actualizar cliente">
</form>
 <?php
  // Cargamos el footer al final de la pagina
  require RUTA_APP . '/views/inc/footer.php';
?>