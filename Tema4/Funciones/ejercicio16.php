<?php
    class Contador{
        static $cuenta=0;

        public function __construct(){
            self::$cuenta++;
        }

        static function getCuenta(){
            return self::$cuenta;
        }
    }
$c1 = new Contador();
$c2 = new Contador();
$c3 = new Contador();
$c4 = new Contador();
$c5 = new Contador();

echo "El valor del contador es: ".Contador::getCuenta();
?>