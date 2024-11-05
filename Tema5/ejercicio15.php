<?php
    class Producto{
        public $nombre;
        public $precio;
        public $cantidad;

        public function __construct($nombre){
            $this->nombre = $nombre;
        }

        public function calcularSubtotal(){
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

    class Factura{
        public $numeroFactura;
        public $nombreCliente;
        public array $productos;

        public function __construct($numeroFactura, array $productos){
            $this->numeroFactura = $numeroFactura;
            $this->productos = $productos;
        }

        public function agregarProducto($producto) {
            foreach ($this->productos as $prodExistente) {
                if ($prodExistente->nombre === $producto->nombre) {
                    $prodExistente->agregarCantidad($producto->cantidad);
                    return;
                }
            }
            //$this->productos[] = $producto;
            array_push($this->productos, $producto);
        }

        public function agregarProducto1(Producto $producto){
            foreach ($this->productos as $productRepe) {
                if ($productRepe->nombre === $producto->nombre) {
                    return $productRepe->cantidad+$producto->cantidad;
                }
                return array_push($this->productos, $producto);
            }
        }

        private function calcularBaseImposible(){
            $baseImponible = 0;
            foreach ($this->productos as $producto) {
                $baseImponible += $producto->calcularSubTotal();
            }
            return $baseImponible;
        }

        private function totalFactura(){
            $baseImponible = $this->calcularBaseImponible();
            $iva = $baseImponible * 0.21;
            return $baseImponible + $iva;
        }

        public function mostrarArticulos(){
            usort($this->productos, function($articulo1, $articulo2){
                foreach ($this->productos as $preciosProd) {

                }
            });
        }

        public function imprimirFactura(){
        }
    }

    $producto1 = new Producto("PC");
    $producto1->precio = 99.99;
    $producto1->cantidad = 2;

    $producto2 = new Producto("Teclado");
    $producto2->precio = 52;
    $producto2->cantidad = 3;

    $producto3 = new Producto("Teclado");
    $producto3->precio = 52;
    $producto3->cantidad = 1;

    //echo $producto1->cacularSubtotal();

    $productos = array();
    $factura1 = new Factura(123456,$productos);
    $factura1->nombreCliente = "Cheng";
    $factura1->agregarProducto($producto1);
    $factura1->agregarProducto($producto2);
    $factura1->agregarProducto($producto3);

    echo $factura1->articulo();

?>