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
        $numerador = ($this->__get("numerador")*$fraccion->__get("denominador"))+($this->__get("denominador")*$fraccion->__get("numerador"));
        $denominador = ($this->__get("denominador")*$fraccion->__get("denominador"));
        return new Racional($numerador, $denominador);
    }

    public function restar(Racional $fraccion){
        $numerador = ($this->__get("numerador")*$fraccion->__get("denominador"))-($this->__get("denominador")*$fraccion->__get("numerador"));
        $denominador = ($this->__get("denominador")*$fraccion->__get("denominador"));
        return new Racional($numerador, $denominador);
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

    public function resultado() {
        echo $this->numerador."\n";
        echo "----\n";
        echo $this->denominador."\n";
    }

    public function esIgual(Racional $fraccion) {
        if ($this->__get("numerador") * $fraccion->__get("denominador") == $fraccion->__get("numerador") * $this->__get("denominador")) {
            return "Son Iguales";
        }else{
            return "No son Iguales";
        }      
    }

    public function copia() {
        return new Racional($this->numerador, $this->denominador);
    }
}

$racional1 = new Racional(2,4);
$racional2 = new Racional(2,4);

echo "La suma de racional es: \n";
$suma = $racional1->sumar($racional2);
echo $suma->resultado();

echo "La resta de racional es: \n";
$restar = $racional1->restar($racional2);
echo $restar->resultado();

echo "La multiplicacion de racional es: \n";
$multiplicar = $racional1->multiplicar($racional2);
echo $multiplicar->resultado();

echo "La division de racional es: \n";
$dividir = $racional1->dividir($racional2);
echo $dividir->resultado();

echo "¿Son iguales?: ".$racional1->esIgual($racional2). "\n";

?>