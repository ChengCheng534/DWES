<?php

function totalInventario($inventario){
    /*
    $productos = array_keys($inventario['producto_1']);

    $total = [];

    foreach($productos as $producto){
        $precio = 0;
        $cantidad = 0;

        foreach($inventario as $articulo => $precioProducto){
            $precio = $precioProducto[$producto];
            
        }

        foreach($inventario as $articulo => $cantidadProducto){
            $cantidad = $cantidadProducto[$producto];
        }
        $total[$producto] = $precio * $cantidad;
    }
    return null;
    */


    $productos =[];

    $producto1 = $inventario['producto_1'];
    $precio1 = $producto1['precio'];
    $cantidad1 = $producto1['cantidad'];
    $precioTotal1 = $precio1 * $cantidad1;

    $producto2 = $inventario['producto_2'];
    $precio2 = $producto2['precio'];
    $cantidad2 = $producto2['cantidad'];
    $precioTotal2 = $precio2 * $cantidad2;

    $producto3 = $inventario['producto_3'];
    $precio3 = $producto3['precio'];
    $cantidad3 = $producto3['cantidad'];
    $precioTotal3 = $precio3 * $cantidad3;

    $producto4 = $inventario['producto_4'];
    $precio4 = $producto4['precio'];
    $cantidad4 = $producto4['cantidad'];
    $precioTotal4 = $precio4 * $cantidad4;

    $producto5 = $inventario['producto_5'];
    $precio5 = $producto5['precio'];
    $cantidad5 = $producto5['cantidad'];
    $precioTotal5 = $precio5 * $cantidad5;
    
    $productos = ['producto_1'=> $precioTotal1, 'producto_2'=> $precioTotal2, 'producto_3'=> $precioTotal3, 'producto_4'=> $precioTotal4, 'producto_5'=> $precioTotal5];
    return $productos;
}


function totalCategoria($inventario){
    $productos = array_keys($inventario['producto_1']);
    $cantidad = 0;

    foreach($productos as $producto){
        foreach($inventario as $producto => $categoria){
            //print_r($categoria);
            
            foreach($categoria as $elementos => $datos){

            }
        }
    }
    return null;
}


$inventario = [
    'producto_1' => ['nombre' => 'Camiseta', 'precio' => 20, 'cantidad' => 50, 'categoria' => 'ropa'],
    'producto_2' => ['nombre' => 'Pantalones', 'precio' => 40, 'cantidad' => 30, 'categoria' => 'ropa'],
    'producto_3' => ['nombre' => 'Zapatos', 'precio' => 60, 'cantidad' => 20, 'categoria' => 'calzado'],
    'producto_4' => ['nombre' => 'Gorra', 'precio' => 15, 'cantidad' => 100, 'categoria' => 'accesorios'],
    'producto_5' => ['nombre' => 'Bolso', 'precio' => 50, 'cantidad' => 10, 'categoria' => 'accesorios']
];

print_r(totalInventario($inventario));
//print_r(totalCategoria($inventario));

?>