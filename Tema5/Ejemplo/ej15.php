<?php
// Clase Producto
class Producto {
    private $nombre;
    private $precio;
    private $cantidad;

    // Constructor de Producto
    public function __construct($nombre, $precio, $cantidad) {
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->cantidad = $cantidad;
    }

    // Método para calcular el subtotal del producto (precio * cantidad)
    public function calcularSubTotal() {
        return $this->precio * $this->cantidad;
    }

    // Métodos getter y setter
    public function getNombre() {
        return $this->nombre;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function getCantidad() {
        return $this->cantidad;
    }

    public function agregarCantidad($cantidad) {
        $this->cantidad += $cantidad;
    }
}

// Clase Factura
class Factura {
    private $numeroFactura;
    private $nombreCliente;
    private $productos;

    // Constructor de Factura
    public function __construct($numeroFactura, $nombreCliente) {
        $this->numeroFactura = $numeroFactura;
        $this->nombreCliente = $nombreCliente;
        $this->productos = []; // Array vacío de productos
    }

    // Método para agregar un producto al array de productos
    public function agregarProducto($producto) {
        // Busca si el producto ya existe en la factura
        foreach ($this->productos as $prodExistente) {
            if ($prodExistente->getNombre() === $producto->getNombre()) {
                // Si el producto ya existe, se incrementa su cantidad
                $prodExistente->agregarCantidad($producto->getCantidad());
                return; // Termina la función para evitar añadirlo de nuevo
            }
        }
        // Si el producto no existe, se agrega al array
        $this->productos[] = $producto;
    }

    // Método privado para calcular la base imponible (sin IVA)
    private function calcularBaseImponible() {
        $baseImponible = 0;
        foreach ($this->productos as $producto) {
            $baseImponible += $producto->calcularSubTotal();
        }
        return $baseImponible;
    }

    // Método privado para calcular el total de la factura aplicando IVA (21% por ejemplo)
    private function totalFactura() {
        $baseImponible = $this->calcularBaseImponible();
        $iva = $baseImponible * 0.21; // 21% de IVA
        return $baseImponible + $iva;
    }

    // Método público para mostrar el resumen de la factura
    public function mostrarFactura() {
        echo "Factura N°: " . $this->numeroFactura . "\n";
        echo "Cliente: " . $this->nombreCliente . "\n";
        echo "Productos:\n";

        foreach ($this->productos as $producto) {
            echo "- " . $producto->getNombre() . " | Precio: $" . $producto->getPrecio() . 
                 " | Cantidad: " . $producto->getCantidad() . 
                 " | Subtotal: $" . $producto->calcularSubTotal() . "\n";
        }

        echo "Base Imponible (sin IVA): $" . $this->calcularBaseImponible() . "\n";
        echo "Total con IVA: $" . $this->totalFactura() . "\n";
    }
}

// Ejemplo de uso del sistema de facturación
// Creación de productos
$producto1 = new Producto("Laptop", 1500.00, 1);
$producto2 = new Producto("Mouse", 25.50, 2);
$producto3 = new Producto("Teclado", 45.99, 1);
$productoRepetido = new Producto("Mouse", 25.50, 3); // Producto repetido

// Creación de la factura
$factura = new Factura(1001, "Juan Pérez");

// Agregando productos a la factura
$factura->agregarProducto($producto1);
$factura->agregarProducto($producto2);
$factura->agregarProducto($producto3);
$factura->agregarProducto($productoRepetido); // Agregando un producto repetido

// Mostrar el resumen de la factura
$factura->mostrarFactura();
?>
