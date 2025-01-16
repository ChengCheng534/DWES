<?php
session_start();


if (isset($_SESSION['carrito'])) {
    $compra = $_SESSION['carrito'];
    print_r($compra);
} else {
    echo "Carrito vacio";
}

?>