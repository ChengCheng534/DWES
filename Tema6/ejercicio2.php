<?php
include 'ICocheDAO.php';
    class Coche{
        private $matricula, $marca, $modelo, $potencia, $velocidadMax;
        
        public function __construct($matricula,$marca, $modelo, $potencia, $velocidadMax){
            $this->matricula = $matricula;
            $this->marca = $marca;
            $this->modelo = $modelo;
            $this->potencia = $potencia;
            $this->velocidadMax = $velocidadMax;
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

        public function __construct() {
            if (!file_exists($this->ficheroCoche)) {
                file_put_contents($this->ficheroCoche, json_encode([]));
            }
        }

        // Alta de coche
        public function crear(Coche $coche){
            // 1) Leer todo el fichero de coches que esta en JSON
            $json_coche = file_get_contents($this->ficheroCoche);
            if ($json_coche === false) {
                die("No se pudo leer el archivo.");
            }
            
            // 2) Lo conviertes en un array de php
            $arrayCoches = json_decode($json_coche, true);

            // 3) Añades dentro del array el coche recibido
            foreach($arrayCoches as $coches){
                if($coches['matricula'] == $coche->matricula){
                    echo "El coche ya exixte, no es posible introducirlo nuevamente.";
                    return -1;
                }
            }

            // Lo añado el coche en el array
            $arrayCoches[] = [
                'matricula' => $coche->matricula,
                'marca' => $coche->marca,
                'modelo' => $coche->modelo,
                'potencia' => $coche->potencia,
                'velocidadMax' => $coche->velocidadMax
            ];
        
            // 4) Conviertes el array a JSON
            $json_str = json_encode($arrayCoches, JSON_PRETTY_PRINT);

            // 5) Guardas en Json en el fichero
            if (file_put_contents($this->ficheroCoche, $json_str) === false) {
                die("No se pudo guardar el archivo JSON.");
            }
            echo "La lista de coches ha sido guardada en '$this->ficheroCoche'.\n";
        } 

        // Devuelve el coche buscado	
        public function obtenerCoche($matricula){
            $json_coche = file_get_contents($this->ficheroCoche);
            if ($json_coche === false) {
                die("No se pudo leer el archivo.");
            }

            $arrayCoches = json_decode($json_coche, true);

            foreach($arrayCoches as $coches){
                if($coches['matricula'] == $matricula){
                    echo "Coche encontrado.\n";
                    echo "\tMatricula: ".$coches['matricula']."\n";
                    echo "\tMarca: ".$coches['marca']."\n";
                    echo "\tModelo: ".$coches['modelo']."\n";
                    echo "\tPotencia: ".$coches['potencia']."\n";
                    echo "\tVelocidad Máxima: ".$coches['velocidadMax'];
                    return -1;
                }
            }
            echo "Coche no encontrado.";
        }

        // Borrado de coche
        public function eliminar($matricula){
            $json_coche = file_get_contents($this->ficheroCoche);
            if ($json_coche === false) {
                die("No se pudo leer el archivo.");
            }
            $arrayCoches = json_decode($json_coche, true);
            foreach($arrayCoches as $coches){
                if($coches['matricula'] == $matricula){
                    unset($arrayCoches['matricula']);
                    unset($arrayCoches['marca']);
                    unset($arrayCoches['modelo']);
                    unset($arrayCoches['Potencia']);
                    unset($arrayCoches['VelocidadMax']);

                    $json_delete = json_encode($arrayCoches, JSON_PRETTY_PRINT);

                    if (file_put_contents($this->ficheroCoche, $json_delete) === false) {
                        die("No se pudo guardar el archivo JSON.");
                    }
                    echo "La lista de coches ha sido elimiado en '$this->ficheroCoche'.\n";
                    return -1;
                }
            }
            echo "Matricula no encontrado.";
        }

        // Modificación de Coche
        public function actualizar($matricula, Coche $nuevoCoche){

        } 

        // devuelve todos los coches almacenados en el fichero
        public function verTodos(){
            $json_coche = file_get_contents($this->ficheroCoche);
            if ($json_coche === false) {
                die("No se pudo leer el archivo.");
            }
            $arrayCoches = json_decode($json_coche, true);
            $contador = 1;
            foreach($arrayCoches as $coches){
                    echo "Coche ".$contador.":\n";
                    echo "\tMatricula: ".$coches['matricula']."\n";
                    echo "\tMarca: ".$coches['marca']."\n";
                    echo "\tMpdelo: ".$coches['modelo']."\n";
                    echo "\tPotencia: ".$coches['potencia']."\n";
                    echo "\tVelocidad Máxima: ".$coches['velocidadMax']."\n\n";
                    $contador++;
            }
            
        }
    }
    $cocheDAO = new CocheDAO();
    $coche1 = new Coche("1234ABC", "Toyota", "Corolla", 110, 180);
    $coche2 = new Coche("5678DEF", "Ford", "Focus", 130, 200);
    $coche3 = new Coche("9862KHT", "Renault", "Trafic", 120, 250);

    //$cocheDAO->crear($coche3);
    //$cocheDAO->obtenerCoche("5678DEF");
    //$cocheDAO->verTodos();
    $cocheDAO->eliminar("9862KHT");
    //$cocheDAO->verTodos();
?>