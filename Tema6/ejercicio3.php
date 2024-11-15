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
        private $ficheroCoche = 'coches.csv';

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
                die("No se pudo leer el archivo.\n");
            }
            
            // 2) Lo conviertes en un array de php
            $arrayCoches = json_decode($json_coche, true);

            // 3) Añades dentro del array el coche recibido
            foreach($arrayCoches as $coches){
                if($coches['matricula'] == $coche->matricula){
                    echo "El coche ya exixte, no es posible introducirlo nuevamente.\n";
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
                die("No se pudo guardar el archivo JSON.\n");
            }
            echo "El coche con matrícula '$coche->matricula' ha sido añadido del archivo '$this->ficheroCoche'.\n";
        } 

        // Devuelve el coche buscado	
        public function obtenerCoche($matricula){
            $json_coche = file_get_contents($this->ficheroCoche);
            if ($json_coche === false) {
                die("No se pudo leer el archivo.\n");
            }

            $arrayCoches = json_decode($json_coche, true);

            foreach($arrayCoches as $coches){
                if($coches['matricula'] == $matricula){
                    echo "Coche encontrado.\n";
                    /*
                    echo "\tMatricula: ".$coches['matricula']."\n";
                    echo "\tMarca: ".$coches['marca']."\n";
                    echo "\tModelo: ".$coches['modelo']."\n";
                    echo "\tPotencia: ".$coches['potencia']."\n";
                    echo "\tVelocidad Máxima: ".$coches['velocidadMax']."\n";
                    */
                    return $coches;
                }
            }
            echo "Coche no encontrado.\n";
            return null;
        }

        // Borrado de coche
        public function eliminar($matricula){
            // 1. Leer el contenido del archivo JSON
            $json_coche = file_get_contents($this->ficheroCoche);
            if ($json_coche === false) {
                die("No se pudo leer el archivo.\n");
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
                die("No se pudo guardar el archivo JSON.\n");
            }
            echo "El coche con matrícula '$matricula' ha sido eliminado del archivo '$this->ficheroCoche'.\n";
        }
        
        // Modificación de Coche
        public function actualizar($matricula, Coche $nuevoCoche){
            // 1. Leer el contenido del archivo JSON
            $json_coche = file_get_contents($this->ficheroCoche);
            if ($json_coche === false) {
                die("No se pudo leer el archivo.\n");
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
                die("No se pudo guardar el archivo JSON.\n");
            }
            echo "El coche con matrícula '$matricula' ha sido modificado en el archivo '$this->ficheroCoche'.\n";
        } 

        // devuelve todos los coches almacenados en el fichero
        public function verTodos(){
            // Abrir el archivo en modo de lectura
            $fp = fopen($this->ficheroCoche, 'r');

            if (!$fp) {
                die("No se pudo abrir el archivo para leer.");
            }
            
            // Leer y mostrar el archivo línea por línea
            while (($linea = fgets($fp)) !== false) {
                // Mostrar cada línea leída (ya incluye el salto de línea)
                $separar = explode("#", $linea);
                //echo $linea;
                //print_r($separar);

                
              
                    printf(
                        "%-10s | %-15s | %-10s | %-10s | %-15s",
                        $separar[0],$separar[1],$separar[2],$separar[3],$separar[4]
                    );
                 
            }
            
        }
    }
    $cocheDAO = new CocheDAO();
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

                // Obtener el coche existente
                $cocheActual = $cocheDAO->obtenerCoche($matricula);
                if ($cocheActual === null) {
                    echo "Coche no encontrado. No se puede modificar.\n";
                break;
                }

                // Solicitar nuevos valores; si se deja en blanco, se mantienen los actuales
                $marca = readline("Modifica la marca (actual: {$cocheActual['marca']}): ");
                $modelo = readline("Modifica el modelo (actual: {$cocheActual['modelo']}): ");
                $potencia = readline("Modifica la potencia (actual: {$cocheActual['potencia']}): ");
                $velocidad = readline("Modifica la velocidad máxima (actual: {$cocheActual['velocidadMax']}): ");

                // Crear el nuevo objeto Coche con los valores modificados (si no están vacíos)
                $cocheNuevo = new Coche(
                    $matricula,
                    !empty($marca) ? $marca : $cocheActual['marca'],
                    !empty($modelo) ? $modelo : $cocheActual['modelo'],
                    !empty($potencia) ? $potencia : $cocheActual['potencia'],
                    !empty($velocidad) ? $velocidad : $cocheActual['velocidadMax']
                );
                
                $cocheDAO->actualizar($matricula, $cocheNuevo);
                break;
            case 4:
                $cocheDAO->verTodos();
                break;
        }
        $opcion = readline("\nIntroducen otro número de opción: \n");
    }
?>