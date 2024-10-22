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
            return "\n\t ·El vehículo ya está devuelto.\n"; 
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

    class ContratoAlquiler{
        public $vehiculo;
        public $cliente;
        public $fechaRecogida;
        public $fechaDevolucion;
        public $estado;

        public function __construct($coche, $cliente){
            // Comprobar que los parametros instanceof
            // Si es correcto los guardo en las propiedades del objeto
            // Si no es correcto mostrarmos error 
            if ($coche instanceof Vehiculo && $cliente instanceof Cliente) {
                // Asignar el vehículo
                $this->vehiculo = $coche;
                $this->cliente = $cliente;
                $this->fechaRecogida = new DateTime;
                $this->estado = "Activo";
            }else{
                echo "Error: El parámetro coche no es una instancia de Vehiculo.\n";
                echo "Error: El parámetro cliente no es una instancia de Cliente.\n";
            }
        }

        public function devolverVehiculo($vehiculo){
            // Comprobamos que el vehiculo con instanceof
            // === comprobamos que lo cogido es lo que devuelves
            if ($vehiculo instanceof Vehiculo && $vehiculo === $this->vehiculo) {
                $this->fechaDevolucion= new DateTime;
                $this->__set("estado","Finalizado");
            }else{
                echo "Error: El parámetro vehiculo no coincide con el vehiculo registrado.\n";
            }
        }

        public function __toString(){
            return $this->estado;
            /*
            echo "Vehículo: ".$this->vehiculo."\n";
            echo "Cliente: ".$this->cliente."\n";
            echo "Fecha de recogida: ".$this->fechaRecogida->format('Y-m-d H:i:s')."\n";
            echo "Fecha de Devuelto: ".$this->fechaDevolucion->format('Y-m-d H:i:s')."\n";
            echo "Estado: ".$this->estado;
            */
        }
    }

    $coche1 = new Vehiculo("8888TNB");
    $coche1->marca="Renault";
    $coche1->modelo="Trafic";
    $coche1->tipo="Furgoneta";

    //Mostrar informacion del vehiculo
    echo $coche1->mostrarInfo();

    //Aquilar el vehiculo
    echo $coche1->alquilar();
    echo $coche1->mostrarInfo();

    //Devuelver el vehiculo
    echo $coche1->devolver();
    echo $coche1->mostrarInfo();

    $cliente1 = new Cliente("C1234567C");
    $cliente1->nombre = "ChengCheng";
    $cliente1->apellido = "Yu";
    echo $cliente1->mostrarInfo();


    $contrato1 = new ContratoAlquiler($coche1, $cliente1);
    echo $contrato1->devolverVehiculo($coche1);
    echo $contrato1->__toString();
?>