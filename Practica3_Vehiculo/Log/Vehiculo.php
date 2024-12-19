<?php
class Vehiculo{
    private $matricula, $marca, $modelo, $potencia, $velocidadMax, $imagen;
    
    public function __construct($matricula,$marca, $imagen){
        $this->matricula = $matricula;
        $this->marca = $marca;
        $this->modelo = "";
        $this->potencia = 0;
        $this->velocidadMax = 0;
        $this->imagen = $imagen;
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

    public function __toString() {
        return $this->matricula . " ". 
            $this->marca ." ". 
            $this->modelo ." ".
            $this->potencia ." ".
            $this->velocidadMax ." ".
            $this->imagen;
    }
}
?>
