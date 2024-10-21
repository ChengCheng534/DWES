<?php
    class Persona{
        public $nombre,$edad;

        public function __construct($nombre, $edad){
            $this -> nombre = $nombre;
            $this -> edad = $edad;
        }

        public function identificate(){
            return "La persona llama ".$this->nombre.
            " y tiene ".$this->edad." años.";
        }
    }

    $persona1= new Persona("Cheng", 21);
    $persona1 -> nombre = "Cheng";
    $persona1 -> edad = 20;

    echo $persona1 -> identificate();

?>