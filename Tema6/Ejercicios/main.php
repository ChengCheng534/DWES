<?php
require_once 'Coche.php';
require_once 'ICocheDAO.php';
require_once 'CocheDAO.php';

$cocheDAO = new CocheDAO();

// Crear coches
$coche1 = new Coche("1234ABC", "Toyota", "Corolla", 110, 180);
$coche2 = new Coche("5678DEF", "Ford", "Focus", 130, 200);

$cocheDAO->crear($coche1);
$cocheDAO->crear($coche2);

// Obtener un coche
$obtenido = $cocheDAO->obtenerCoche("1234ABC");
echo $obtenido . "\n";

// Actualizar un coche
$cocheActualizado = new Coche("1234ABC", "Toyota", "Corolla", 120, 190);
$cocheDAO->actualizar("1234ABC", $cocheActualizado);

// Ver todos los coches
$coches = $cocheDAO->verTodos();
foreach ($coches as $coche) {
    echo $coche . "\n";
}

// Eliminar un coche
$cocheDAO->eliminar("5678DEF");
?>
