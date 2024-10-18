<?php

class Racional {
    private $numerador;
    private $denominador;

    /*
    public function constructoDefecto($numerador=0,$denominador=1){
        $this->numerador = $numerador;
        $this->denominador = ($denominador==0) ? 1: $denominador;
    }

    public function constructorParametrizado($numerador, $denominador) {
        return new Racional($numerador, ($denominador == 0) ? 1 : $denominador);
    }
*/
    public function __construct($numerador, $denominador){
        $this->numerador = $numerador;
        $this->denominador =  $denominador;
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
    
    public function sumar(Racional $fraccion){
        $numerador = ($this->numerador*$fraccion->getDenominador())+($this->denominador*$fraccion->getNumerador());
        $denominador = ($this->denominador*$fraccion->getDenominador());
        return new Racional($numerador, $denominador);
      
    }

    public function resultado() {
        echo $this->numerador."/".$this->denominador;
    }
}

$racional1 = new Racional(3,4);
$racional2 = new Racional(5,3);

$suma = $racional1->sumar($racional2);
echo $suma->resultado();

?>