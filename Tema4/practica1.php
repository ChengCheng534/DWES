<?php
    class Vehiculo{
        public $matricula, $marca, $modelo, $tipo, $estaAlquilado;
        
        public function __construct($matricula){
            $this->matricula=$matricula;
            $this->estaAlquilado = "Disponible";
        }

        public function mostrarInfo(){
            echo "_____________________________________________________________\n";
            echo "Vehiculo: \n"; 
            echo "\tMatrícula: ".$this->matricula."\n";
            echo "\tMarca: ".$this->marca."\n";
            echo "\tModelo: ".$this->modelo."\n";
            echo "\tTipo: ".$this->tipo."\n";
            echo "\tEstado: ".$this->estaAlquilado."\n";
            echo "_____________________________________________________________\n";
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

        public function alquilar(){
            if ($this->__get("estadoAlquilado") != "Alquilado") {
                $this->__set("estaAlquilado", "Aquilado");
                return "\n\t ·El vehículo ya está alquilado.\n";
            }elseif ($this->__get("estadoAlquilado") == "Alquilado") {
                return "El vehiculo ha sido alquilado por otro usuario.\n"; 
            }
        }

        public function devolver(){
            $this->__set("estaAlquilado", "Devuelto");
            return "\n\t ·El vehículo ya está Devuelto.\n"; 
        }

        public function costeVehiculo(){

        }
    }

    class Cliente{
        public $nombre, $apellido, $DNI;

        public function __construct($DNI){
            $this->DNI = $DNI;
        }

        public function mostrarInfo(){
            echo "_____________________________________________________________\n";
            echo "Cliente: \n";
            echo "\tNombre: ".$this->nombre."\n";
            echo "\tApellido: ".$this->apellido."\n";
            echo "\tDNI: ".$this->DNI."\n";
            echo "_____________________________________________________________\n";
        }
    }



    $coche1 = new Vehiculo("8888TNB");
    $coche1->marca="Mercede";
    $coche1->modelo="Amg cla45s";
    $coche1->tipo="Coupe";

    //Mostrar informacion del vehiculo
    echo $coche1->mostrarInfo();

    /*
    //Aquilar el vehiculo
    echo $coche1->alquilar();
    echo $coche1->mostrarInfo();

    //Devuelver el vehiculo
    echo $coche1->devolver();
    echo $coche1->mostrarInfo();
    */

    $cliente1 = new Cliente("C1234567C");
    $cliente1->nombre = "ChengCheng";
    $cliente1->apellido = "Yu";
    echo $cliente1->mostrarInfo();

?>