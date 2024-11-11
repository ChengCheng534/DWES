<?php
    class Producto{
        public $nombre;
        public $precio;
        public $cantidad;

        public function __construct($nombre){
            $this->nombre = $nombre;
            $this->precio = 0.00;
            $this->cantidad = 0;
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
                if ($prodExistente->nombre === $producto->nombre && 
                        $prodExistente->precio === $producto->precio) {
                    $prodExistente->agregarCantidad($producto->cantidad);
                    return;
                }
            }
            //$this->productos[] = $producto;
            array_push($this->productos, $producto);
        }

        private function calcularBaseImponible(){
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
                if ($articulo2->calcularSubtotal == $articulo1->calcularSubtotal) {
                    return strcmp($articulo1->nombre, $articulo2->nombre);
                }
                return $articulo2->calcularSubtotal <=> $articulo1->calcularSubtotal;
            });

            foreach ($this->productos as $producto) {
                echo "- ".$producto->nombre.":\n\t Precio: ".$producto->precio. 
                "€\n\t Subtotal: $".$producto->calcularSubTotal()."€\n";
            }
        }

        public function imprimirFactura(){
            echo "<p>Factura número: ".$this->numeroFactura."\t\t\t\tCliente: ".$this->nombreCliente."</p>\n";
            echo "Artículo\t\tPrecio\t\tCantidad\t\tSubtotal\n";
            foreach ($this->productos as $producto) {
                echo $producto->nombre."\t\t\t\t";
                echo $producto->precio."\t\t\t";
                echo $producto->cantidad."\t\t\t";
                echo $producto->calcularSubtotal()."\n";
                
            }
            echo "\n\t\t\t\t\t\t Base Imposible: \t".$this->calcularBaseImponible()."€";
            echo "\n\t\t\t\t\t\t IVA 21%: \t\t".$this->calcularBaseImponible()*0.21."€";
            echo "\n\t\t\t\t\t\t Total Factura: \t".$this->totalFactura()."€";
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

    $producto4 = new Producto("Teclado");
    $producto4->precio = 45;
    $producto4->cantidad = 1;
    //echo $producto1->cacularSubtotal();

    $productos = array();
    $factura1 = new Factura(123456,$productos);
    $factura1->nombreCliente = "Cheng";
    $factura1->agregarProducto($producto1);
    $factura1->agregarProducto($producto2);
    $factura1->agregarProducto($producto3);
    $factura1->agregarProducto($producto4);

    //echo $factura1->mostrarArticulos();
    echo $factura1->imprimirFactura();


?>