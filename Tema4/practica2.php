<?php

class Racional {
    private $numerador;
    private $denominador;

    public function __construct($numerador, $denominador){
        $this->numerador = $numerador;
        $this->denominador =  $denominador;
    }
    /*
    public function __construct () {
        $this->numerador = 3;
        $this->denominador= 5;
    }
    */
    
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
        if ($this->denominador==$fraccion->denominador) {
            $this->$numerador = $this->numerador+$fraccion->numerador;
            $this->$denominador = $this->denominador;
            return new Racional($numerador, $denominador);
        }else{
            $this->numerador = ($this->numerador*$fraccion->denominador)+($this->denominador*$fraccion->numerador);
            $this->denominador = ($this->denominador*$fraccion->denominador);
            return new Racional($numerador, $denominador);
        }
    }

    public function restar(Racional $fraccion){
        if ($this->denominador==$fraccion->denominador) {
            $this->numerador = $this->numerador-$fraccion->numerador;
            $this->denominador = $this->denominador;
            return new Racional($numerador, $denominador);
        }else{
            $numerador = ($this->__get("numerador")*$fraccion->__get("denominador"))-($this->__get("denominador")*$fraccion->__get("numerador"));
            $denominador = ($this->__get("denominador")*$fraccion->__get("denominador"));
            return new Racional($numerador, $denominador);
        }
    }

    public function multiplicar(Racional $fraccion){
        $this->numerador = ($this->__get("numerador")*$fraccion->__get("numerador"));
        $denominador = ($this->__get("denominador")*$fraccion->__get("denominador"));
        return new Racional($this->numerador, $this->denominador);
    }

    public function dividir(Racional $fraccion){
        $numerador = ($this->__get("numerador")*$fraccion->__get("denominador"));
        $denominador = ($this->__get("denominador")*$fraccion->__get("numerador"));
        return new Racional($numerador, $denominador);
    }

    public function esIgual(Racional $fraccion) {
        $f1 = calculaReal();
        $f2 = $fraccion->numerador / $fraccion->denominador;
        if ($f1==$f2) 
            return true;
        else 
            return false;
        
    }

    public function copia() {
        return new Racional($this->numerador, $this->denominador);
    }

    public function setRacional($numerador, $denominador) {
        $this->numerador = $numerador;
        $this->denominador = $denominador;
    }

    public function calculaReal() {
        return $this->numerador / $this->denominador;
    }

    public function __toString() {
        $s = "\t ".$this->numerador."\n";
        $s .= "\t----\n";
        $s .= "\t ".$this->denominador."\n";
        return $s;
    }
}

$racional1 = new Racional(10,4);
echo $racional1;

$racional2 = new Racional(7,4);

echo "Suma de: ".$racional1->__get("numerador")."/".$racional1->__get("denominador")
." + ".$racional2->__get("numerador")."/".$racional2->__get("denominador")." es: \n";
$suma = $racional1->sumar($racional2);
echo $suma->resultado();

echo "Resta de: ".$racional1->__get("numerador")."/".$racional1->__get("denominador")
." - ".$racional2->__get("numerador")."/".$racional2->__get("denominador")." es: \n";
$restar = $racional1->restar($racional2);
echo $restar->resultado();

echo "Multiplicacion de: ".$racional1->__get("numerador")."/".$racional1->__get("denominador")
." X ".$racional2->__get("numerador")."/".$racional2->__get("denominador")." es: \n";
$multiplicar = $racional1->multiplicar($racional2);
echo $multiplicar->resultado();

echo "División de: ".$racional1->__get("numerador")."/".$racional1->__get("denominador")
." ÷ ".$racional2->__get("numerador")."/".$racional2->__get("denominador")." es: \n";
$dividir = $racional1->dividir($racional2);
echo $dividir->resultado();

echo "¿Las dos fraciones son iguales? ".$racional1->esIgual($racional2). "\n";
echo "El resultado de calculo es: ".$racional1->calculaReal()."\n";

?>