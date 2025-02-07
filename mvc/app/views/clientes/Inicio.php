<?php 
  // Cargamos el header previamente
  require RUTA_APP . '/views/inc/header.php';

//print_r($datos); // Esta variable viene del controlador
?>
<div class="container mt-5">
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Cliente id</th>
        <th>Documento identidad</th>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>Email</th>
        <th>Teléfono</th>
        <th>Dirección</th>
        <th>Fecha Nacimiento</th>
        <th>Fotografía</th>
        <th>Operacion</th>
      </tr>
    </thead>
    <tbody>
      <?php
        // Recorrer el array $datos y crear las filas de la tabla
        foreach ($datos['Clientes'] as $clientes) {
          echo "<tr>";
          echo "<td rowspan='2'>" . $clientes->cliente_id . "</td>";
          echo "<td rowspan='2'>" . $clientes->DOCUMENTO_IDENTIDAD . "</td>";
          echo "<td rowspan='2'>" . $clientes->nombre . "</td>";
          echo "<td rowspan='2'>" . $clientes->apellidos . "</td>";
          echo "<td rowspan='2'>" . $clientes->email . "</td>";
          echo "<td rowspan='2'>" . $clientes->telefono . "</td>";
          echo "<td rowspan='2'>" . $clientes->direccion . "</td>";
          echo "<td rowspan='2'>" . $clientes->fecha_nacimiento . "</td>";
          echo "<td rowspan='2'>" . $clientes->fotografia . "</td>";
          //echo "<img src='../img/" . $clientes->fotografia . "' alt='foto'>";
          echo "<td><a href=\"Clientes/visualizarBorrado/$clientes->cliente_id\">Borrar</a></td>";
          echo "</tr>";
          echo "<tr>";
          echo "<td><a href=\"Clientes/visualizarEditar/$clientes->cliente_id\">Editar</a></td>";
          echo "</tr>";
      }
      ?>
    </tbody>
  </table>
</div>

 <?php
  // Cargamos el footer al final de la pagina
  require RUTA_APP . '/views/inc/footer.php';
?>