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
            echo "El coche con matrícula '$coche->matricula' ha sido añadido del archivo '$this->ficheroCoche'.\n";
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
            // 1. Leer el contenido del archivo JSON
            $json_coche = file_get_contents($this->ficheroCoche);
            if ($json_coche === false) {
                die("No se pudo leer el archivo.");
            }
            
            // 2. Decodificar el JSON en un array de coches
            $arrayCoches = json_decode($json_coche, true);
            $cocheEncontrado = false;
        
            // 3. Buscar y eliminar el coche con la matrícula especificada
            foreach ($arrayCoches as $cont => $coches) {
                if ($coches['matricula'] == $matricula) {
                    // Eliminar el coche encontrado
                    unset($arrayCoches[$cont]);
                    $cocheEncontrado = true;
                    break;
                }
            }
        
            // 4. Verificar si el coche fue encontrado y eliminado
            if (!$cocheEncontrado) {
                echo "Matrícula no encontrada.\n";
                return;
            }

            // 5. Codificar el array actualizado a JSON y guardarlo en el archivo
            $json_delete = json_encode($arrayCoches, JSON_PRETTY_PRINT);
            if (file_put_contents($this->ficheroCoche, $json_delete) === false) {
                die("No se pudo guardar el archivo JSON.");
            }
            echo "El coche con matrícula '$matricula' ha sido eliminado del archivo '$this->ficheroCoche'.\n";
        }
        
        // Modificación de Coche
        public function actualizar($matricula, Coche $nuevoCoche){
            // 1. Leer el contenido del archivo JSON
            $json_coche = file_get_contents($this->ficheroCoche);
            if ($json_coche === false) {
                die("No se pudo leer el archivo.");
            }
            
            // 2. Decodificar el JSON en un array de coches
            $arrayCoches = json_decode($json_coche, true);
            $cocheEncontrado = false;

            // 3. Buscar y modificar el coche
            foreach ($arrayCoches as &$coches) {
                if ($coches['matricula'] === $matricula) {
                    // Actualizar los detalles del coche encontrado
                    $coches['marca'] = $nuevoCoche->marca;
                    $coches['modelo'] = $nuevoCoche->modelo;
                    $coches['potencia'] = $nuevoCoche->potencia;
                    $coches['velocidadMax'] = $nuevoCoche->velocidadMax;
                    $cocheEncontrado = true;
                    break;
                }
            }

            // 4. Verificar si el coche fue encontrado y eliminado
            if (!$cocheEncontrado) {
                echo "Matrícula no encontrada.\n";
                return;
            }

            // 5. Codificar el array actualizado a JSON y guardarlo en el archivo
            $json_modif = json_encode($arrayCoches, JSON_PRETTY_PRINT);
            if (file_put_contents($this->ficheroCoche, $json_modif) === false) {
                die("No se pudo guardar el archivo JSON.");
            }
            echo "El coche con matrícula '$matricula' ha sido modificado en el archivo '$this->ficheroCoche'.\n";
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
                    echo "\tVelocidad Máxima: ".$coches['velocidadMax']."\n";
                    $contador++;
            }
            
        }
    }
    $cocheDAO = new CocheDAO();
    $coche1 = new Coche("1234ABC", "Toyota", "Corolla", 110, 180);
    $coche2 = new Coche("5678DEF", "Ford", "Focus", 130, 200);
    $coche3 = new Coche("9862KHT", "Renault", "Trafic", 120, 250);
    $nuevoCoche = new Coche("9862KHT", "Opel", "Coupe", 120, 250);
    
    //Crear coche.
    $cocheDAO->crear($coche1);
    $cocheDAO->crear($coche2);
    $cocheDAO->crear($coche3);

    //Mostrar determinado coche.
    //$cocheDAO->obtenerCoche("5678DEF");

    //Eliminar coche.
    //$cocheDAO->eliminar("1234ABC");

    //Actulizar datos de coches.
    //$cocheDAO->actualizar("9862KHT",$nuevoCoche);

    //Mostrar todos los coches.
    //$cocheDAO->verTodos();

    $menu = <<<'MENU'
    1) Alta nueva de Coche.
    2) Baja por matrícula.
    3) Modificación.
    4) Listado de coches.
    5) Salir de la aplicación.
    MENU;
    echo $menu;

    $opcion = readline("\nIntroducen el número de opción: ");
    while ($opcion < 5) {
        switch($opcion){
            case 1:
                $matricula = null;
                while ($matricula == null){
                    $matricula = readline("Introducen la matricula: ");
                }
                $marca = null;
                while ($marca == null){
                    $marca = readline("Introducen la marca: ");
                }
                $modelo = null;
                while ($modelo == null){
                    $modelo = readline("Introducen el modelo: ");
                }
                $potencia = null;
                while ($potencia == null){
                    $potencia = readline("Introducen la potencia: ");
                }
                $velocidad = null;
                while ($velocidad == null){
                    $velocidad = readline("Introducen la velocidad máxima: ");
                }
                $coche = new Coche($matricula, $marca, $modelo, $potencia, $velocidad);
                $cocheDAO->crear($coche);
                break;
            case 2:
                // Solicitar la matrícula del coche a eliminar
                $matricula = null;
                while ($matricula == null) {
                    $matricula = readline("\nIntroduce la matrícula del coche que deseas eliminar: ");
                }

                // Confirmar la eliminación
                $confirmacion = readline("¿Estás seguro de que quieres eliminar el coche con matrícula '$matricula'? (s/n): ");
                if (strtolower($confirmacion) !== 's') {
                    echo "Operación cancelada. No se ha eliminado ningún coche.\n";
                    break;
                }
            
                // Llamar al método para eliminar el coche 
                $cocheDAO->eliminar($matricula);
                break;
            case 3:
                // Solicitar la matrícula del coche a eliminar
                $matricula = null;
                while ($matricula == null) {
                    $matricula = readline("\nIntroduce la matrícula del coche que deseas modificar: ");
                }

                //Modificar
                $marca = readline("Modifica la marca: ");
                $modelo = readline("Modifica el modelo: ");
                $potencia = readline("Modifica la potencia: ");
                $velocidad = readline("Modifica la velocidad máxima: ");
                $cocheNuevo = new Coche($matricula, $marca, $modelo, $velocidad, $coche);

                $cocheDAO->actualizar($matricula, $cocheNuevo);
                break;
            case 4:
                $cocheDAO->verTodos();
                break;
        }
        $opcion = readline("\nIntroducen otro número de opción: ");
    }
?>