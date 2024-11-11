<?php
    class Producto {
        public $nombre;
        public $precio;
        public $cantidad;

        public function __construct($nombre) {
            $this->nombre = $nombre;
            $this->precio = 0.00;
            $this->cantidad = 0;
        }

        public function calcularSubtotal() {
            return $this->precio * $this->cantidad;
        }

        public function agregarCantidad($cantidad) {
            $this->cantidad += $cantidad;
        }

        public function __get($propiedad) {
            if (property_exists($this, $propiedad)) {
                return $this->$propiedad;
            }
        }

        public function __set($propiedad, $valor) {
            if (property_exists($this, $propiedad)) {
                $this->$propiedad = $valor;
            }
        }
    }

    class Factura {
        public $numeroFactura;
        public $nombreCliente;
        public array $productos;

        public function __construct($numeroFactura, array $productos) {
            $this->numeroFactura = $numeroFactura;
            $this->productos = $productos;
        }

        public function agregarProducto($producto) {
            foreach ($this->productos as $prodExistente) {
                if ($prodExistente->nombre === $producto->nombre && 
                        $prodExistente->precio === $producto->precio) {
                    $prodExistente->agregarCantidad($producto->cantidad);
                    return;
                }
            }
            array_push($this->productos, $producto);
        }

        private function calcularBaseImponible() {
            $baseImponible = 0;
            foreach ($this->productos as $producto) {
                $baseImponible += $producto->calcularSubtotal();
            }
            return $baseImponible;
        }

        private function totalFactura() {
            $baseImponible = $this->calcularBaseImponible();
            $iva = $baseImponible * 0.21;
            return $baseImponible + $iva;
        }

        public function mostrarArticulos() {
            usort($this->productos, function($articulo1, $articulo2) {
                if ($articulo2->calcularSubtotal() == $articulo1->calcularSubtotal()) {
                    return strcmp($articulo1->nombre, $articulo2->nombre);
                }
                return $articulo2->calcularSubtotal() <=> $articulo1->calcularSubtotal();
            });

            foreach ($this->productos as $producto) {
                printf("%-20s %-10.2f %-10d %-10.2f\n", $producto->nombre, $producto->precio, $producto->cantidad, $producto->calcularSubtotal());
            }
        }
        
        public function imprimirFactura() {
            printf("<table border='1'>
                    <tr>
                        <th>Producto</th>
                        <th>Precio Unitaria</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                    </tr>");

            foreach ($this->productos as $producto) {
                printf("<tr>
                            <td>%'#-20s</td>
                            <td>%'@10.2f</td>
                            <td>%5d</td>
                            <td>%10.2f</td>
                        </tr>", $producto->nombre, 
                                $producto->precio, 
                                $producto->cantidad, 
                                $producto->calcularSubtotal());
            }
            printf("<tr>
                        <td colspan='1' align='right'>Base Imponible:</td>
                        <td></td>
                        <td></td>
                        <td>%10.2f</td>
                    </tr>", $this->calcularBaseImponible());
            
            printf("<tr>
                        <td colspan='1' align='right'>IVA 21%%:</td>
                        <td></td>
                        <td></td>
                        <td>%10.2f</td>
                    </tr>", $this->calcularBaseImponible() * 0.21);
            
            printf("<tr>
                        <td colspan='1' align='right'>Total Factura:</td>
                        <td></td>
                        <td></td>
                        <td>%10.2f</td>
                    </tr>", $this->totalFactura());
            
            echo "</table>";
        }
        
    }
    // Creación de productos
    $producto1 = new Producto("PC");
    $producto1->precio = 99.99;
    $producto1->cantidad = 2;

    $producto2 = new Producto("Teclado");
    $producto2->precio = 52;
    $producto2->cantidad = 3;

    $producto3 = new Producto("Teclado");
    $producto3->precio = 52;
    $producto3->cantidad = 1;

    $producto4 = new Producto("Teclado");
    $producto4->precio = 45;
    $producto4->cantidad = 1;

    // Crear la factura
    $productos = array();
    $factura1 = new Factura(123456, $productos);
    $factura1->nombreCliente = "Cheng";
    $factura1->agregarProducto($producto1);
    $factura1->agregarProducto($producto2);
    $factura1->agregarProducto($producto3);
    $factura1->agregarProducto($producto4);

    // Imprimir la factura con formato
    echo $factura1->imprimirFactura();
?>
