<?php
    class Vehiculo{
        public $matricula, $marca, $modelo, $tipo;
        private $estaAlquilado = "Disponible";
        
        public function __construct($matricula){
            $this->matricula=$matricula;
        }

        public function mostrarIformacion(){
            echo "Vehiculo: \n"; 
            echo "\tMatrícula: ".$this->matricula."\n";
            echo "\tMarca: ".$this->marca."\n";
            echo "\tModelo: ".$this->modelo."\n";
            echo "\tTipo: ".$this->tipo."\n";
            echo "\tEstado: ".$this->estaAlquilado."\n";
        }

        public function aquilar($estaAlquilado, $verdadero) {
            if ($verdadero == true) {
                $this->$estaAlquilado = "alquilado";
                return "-El vehiculo ha sido alquilado.\n";
            }
        }
        public function devolver($estaAlquilado, $verdadero) {
            if ($verdadero == true) {
                $this->$estaAlquilado = "disponible";
                return "-El vehiculo ha sido devuelto.\n";
            }
        }
    }

    class Cliente{
        private $nombre, $apellido, $DNI;

        public function __construct($nombre, $apellido, $DNI){
            $this->nombre = $nombre;
            $this->apellido = $apellido; 
            $this->DNI = $DNI;
        }
    }

    $coche1 = new Vehiculo("1234ABC");
    $coche1->marca=("mercede");
    $coche1->modelo=("Amg cla45s");
    $coche1->tipo=("Coupe");

    echo $coche1->mostrarIformacion();

    echo $coche1->aquilar("estaAlquilado",true);
    echo $coche1->mostrarIformacion();

    echo $coche1->devolver("estaAlquilado",true);
    echo $coche1->mostrarIformacion();
?>