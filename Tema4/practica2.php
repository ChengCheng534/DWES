<?php

class Racional {
    private $numerador;
    private $denominador;

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
        if ($this->__get("denominador")==$fraccion->__get("denominador")) {
            $numerador = $this->__get("numerador")+$fraccion->__get("numerador");
            $denominador = $this->__get("denominador");
            return new Racional($numerador, $denominador);
        }else{
            $numerador = ($this->__get("numerador")*$fraccion->__get("denominador"))+($this->__get("denominador")*$fraccion->__get("numerador"));
            $denominador = ($this->__get("denominador")*$fraccion->__get("denominador"));
            return new Racional($numerador, $denominador);
        }
    }

    public function restar(Racional $fraccion){
        if ($this->__get("denominador")==$fraccion->__get("denominador")) {
            $numerador = $this->__get("numerador")-$fraccion->__get("numerador");
            $denominador = $this->__get("denominador");
            return new Racional($numerador, $denominador);
        }else{
            $numerador = ($this->__get("numerador")*$fraccion->__get("denominador"))-($this->__get("denominador")*$fraccion->__get("numerador"));
            $denominador = ($this->__get("denominador")*$fraccion->__get("denominador"));
            return new Racional($numerador, $denominador);
        }
    }

    public function multiplicar(Racional $fraccion){
        $numerador = ($this->__get("numerador")*$fraccion->__get("numerador"));
        $denominador = ($this->__get("denominador")*$fraccion->__get("denominador"));
        return new Racional($numerador, $denominador);
    }

    public function dividir(Racional $fraccion){
        $numerador = ($this->__get("numerador")*$fraccion->__get("denominador"));
        $denominador = ($this->__get("denominador")*$fraccion->__get("numerador"));
        return new Racional($numerador, $denominador);
    }

    public function esIgual(Racional $fraccion) {
        if ($this->__get("numerador") * $fraccion->__get("denominador") == $fraccion->__get("numerador") * $this->__get("denominador")) {
            return "Son Iguales.";
        }else{
            return "No son Iguales.";
        }      
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

    public function resultado() {
        echo "\t ".$this->numerador."\n";
        echo "\t----\n";
        echo "\t ".$this->denominador."\n";
    }
}

$racional1 = new Racional(10,4);
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