<?php
session_start();

if (isset($_SESSION['carrito'])) {
    $compra = $_SESSION['carrito'];

    // Encabezados de la tabla
    printf("%-20s&nbsp&nbsp %-10s&nbsp&nbsp %-10s&nbsp&nbsp %-10s", 
    "Artículo", "Cantidad", "Precio", "Subtotal");
    echo "<br>";
    printf("%'-50s\n", ""); // Línea separadora
    echo "<br>";

    $cantidad = 0;
    $precio = 0;
    $subtotal = 0;
    
    foreach ($compra as $articulo => $valor) {
        list($cantidad, $precio) = explode("#", $valor);
        $cantidad = (int)$cantidad;
        $precio = (float)$precio;
        $subtotal = $cantidad*$precio;

        $compra[$articulo] = [
            "cantidad" => $cantidad,
            "precio" => $precio,
            "subtotal" => $subtotal
        ];

        printf("%20s %-10d %-10d %-10d<br>",
        $articulo,
        $cantidad,
        $precio,
        $subtotal);
    }

} else {
    echo "Carrito vacio";
}

?>