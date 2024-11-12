<?php
include 'ICocheDAO.php';
    class Coche{
        private $matricula, $marca, $modelo, $potencia, $velocidadMax;
        
        public function __construct($matricula){
            $this->matricula = $matricula;
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

        public function __toString() {
            return $this->matricula . " ". 
                $this->marca ." ". 
                $this->modelo ." ".
                $this->potencia ." ".
                $this->velocidadMax;
        }
    }

    class CocheDAO implements ICocheDAO{
        private $ficheroCoche = 'coches.json';

        // Alta de coche
        public function crear(Coche $coche){
            // 1) Leer todo el fichero de coches que esta en JSON
            $json_coche = file_get_contents($this->ficheroCoche);
            if ($json_str === false) {
                die("No se pudo leer el archivo.");
            }
            
            // 2) Lo conviertes en un array de php
            $arrayCoches = json_decode($json_coche, true);

            // 3) Añades dentro del array el coche recibido
            if (array_push($arrayCoches, $coche) === false) {
                die("No se pudo guardar el archivo JSON.");
            }

            // 4) Conviertes el array a JSON
            $json_str = json_encode($arrayCoches, JSON_PRETTY_PRINT);

            // 5) Guardas en Json en el fichero
            if (file_put_contents($archivo, $json_str) === false) {
                die("No se pudo guardar el archivo JSON.");
            }

            echo "La lista de personas ha sido guardada en '$archivo'.\n";
        } 

        // Devuelve el coche buscado	
        public function obtenerCoche($matricula){

        }

        // Borrado de coche
        public function eliminar($matricula){

        }

        // Modificación de Coche
        public function actualizar($matricula, Coche $nuevoCoche){

        } 

        // devuelve todos los coches almacenados en el fichero
        public function verTodos(){

        }
    }
    
?>