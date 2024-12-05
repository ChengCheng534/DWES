<?php
    class Corredor{
        private $id, $nombre, $edad, $nacionalidad; 
        private Array $carreras;

        public function __construct($id) {
            $this->id = $id;
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

        public function __toString(){
            return $this->id ."\n ". 
                $this->nombre ."\n ". 
                $this->edad ."\n ". 
                $this->nacionalidad ."\n ". 
                $this->carreras;
        }
    }

    class Carrera{
        private $id, $nombre, $fecha, $ubicacion, $precio, $tiempoTotal, $kms;

        public function __construct($id) {
            $this->id = $id;
        }

        public function __get($propiedad) {
            if (property_exists($this, $propiedad)) {
                echo $this->$propiedad;
            }
        }
    
        public function __set($propiedad, $valor) {
            if (property_exists($this, $propiedad)) {
                $this->$propiedad = $valor;
            }
        }

        public function __toString(){
            return $this->id .", ". 
                $this->nombre .", ". 
                $this->fecha .", ". 
                $this->ubicacion .", ". 
                $this->precio .", ". 
                $this->tiempoTotal.", ". 
                $this->kms;
        }
    }

    $carrera1 = new Carrera(1);
    $carrera1->nombre= "primerCarrera";
    $carrera1->fecha = Date('Y-m-d');
    $carrera1->ubicacion = "Logroño";
    $carrera1->precio ="34";
    $carrera1->tiempoTotal = null;
    $carrera1->kms = "12";

    $carrera2 = new Carrera(2);
    $carrera2->nombre= "segundoCarrera";
    $carrera2->fecha = Date('Y-m-d');
    $carrera2->ubicacion = "Bilbao";
    $carrera2->precio ="37";
    $carrera2->tiempoTotal = null;
    $carrera2->kms = "10";

    $carrera3 = new Carrera(3);
    $carrera3->nombre= "cuartaCarrera";
    $carrera3->fecha = Date('Y-m-d');
    $carrera3->ubicacion = "Sorias";
    $carrera3->precio ="31";
    $carrera3->tiempoTotal = null;
    $carrera3->kms = "9";

    $carrera4 = new Carrera(4);
    $carrera4->nombre= "quintaCarrera";
    $carrera4->fecha = Date('Y-m-d');
    $carrera4->ubicacion = "Nájera";
    $carrera4->precio ="24";
    $carrera4->tiempoTotal = null;
    $carrera4->kms = "11";

    $carrera5 = new Carrera(5);
    $carrera5->nombre= "terceroCarrera";
    $carrera5->fecha = Date('Y-m-d');
    $carrera5->ubicacion = "Burgos";
    $carrera5->precio ="29";
    $carrera5->tiempoTotal = null;
    $carrera5->kms = "15";

    //echo $carrera1;

    $corredor1 = new Corredor(12345);
    $corredor1->nombre ="Juan";
    $corredor1->edad = 24;
    $corredor1->nacionalidad = "Spain";
    $corredor1->carreras = array_merge(explode(", ",$carrera1));

    print_r($corredor1);

?>