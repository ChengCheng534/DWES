<?php
   echo "<p><strong>Nombre del archivo actual:</strong> " . htmlspecialchars($_SERVER['SCRIPT_NAME']) . "</p>";
   echo "<p><strong>Nombre del servidor:</strong> " . htmlspecialchars($_SERVER['SERVER_NAME']) . "</p>";
   echo "<p><strong>Dirección IP del servidor:</strong> " . htmlspecialchars($_SERVER['SERVER_ADDR']) . "</p>";
   echo "<p><strong>Dirección IP del cliente:</strong> " . htmlspecialchars($_SERVER['REMOTE_ADDR']) . "</p>";
   echo "<p><strong>User Agent del navegador:</strong> " . htmlspecialchars($_SERVER['HTTP_USER_AGENT']) . "</p>";
   echo "<p><strong>Protocolo de la solicitud HTTP:</strong> " . htmlspecialchars($_SERVER['SERVER_PROTOCOL']) . "</p>";
   echo "<p><strong>Método de solicitud HTTP:</strong> " . htmlspecialchars($_SERVER['REQUEST_METHOD']) . "</p>";
   echo "<p><strong>URI de solicitud:</strong> " . htmlspecialchars($_SERVER['REQUEST_URI']) . "</p>";

?>
