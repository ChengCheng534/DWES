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
        /* Tamaño de valor: total(90)
            Matricula(10)
            Marca(30)
            Modelo(30)
            Potencia(10)
            VelocidadMax(10)
        */
        public function crear(Coche $coche) {
            //Seleccionar el matricula de coche.
            $matriculaCoche = $coche->matricula;

            if ($this->obtenerCoche($matriculaCoche)  != null) { //Si esta el coche
                echo "Coche ya existe.\n";
                //fclose($fp);
                return false;
            }
            // Abrir el archivo en modo 'a' para añadir al final
            $fp = fopen($this->ficheroCoche, 'a');
    
            // Verificar si el archivo se abrió correctamente
            if (!$fp) {
                echo "No se pudo abrir el archivo para escribir.";
                return false;
            }

            $linea = implode("#", [
                str_pad(substr($coche->matricula, 0, 10), 10, " ", STR_PAD_RIGHT),
                str_pad(substr($coche->marca, 0, 30), 30, " ", STR_PAD_RIGHT),
                str_pad(substr($coche->modelo, 0, 30), 30, " ", STR_PAD_RIGHT),
                str_pad(substr($coche->potencia, 0, 10), 10, " ", STR_PAD_RIGHT),
                str_pad(substr($coche->velocidadMax, 0, 10), 10, " ", STR_PAD_RIGHT)
            ]) . "\n";

            if (fputs($fp, $linea) === false) {
                echo "\tError al escribir en el archivo.\n";
                fclose($fp);
                return false;
            }
            //fwrite($fp, $linea);
            fclose($fp);

            echo "\tCoche añadido correctamente.\n";
            return true;
        }

        // Devuelve el coche buscado	
        public function obtenerCoche($matricula) {
            // Abrir el archivo en modo de lectura
            $fp = fopen($this->ficheroCoche, 'r');
            if (!$fp) {
                echo "No se pudo abrir el archivo para leer.";
                return;
            }
        
            // Leer el archivo línea por línea
            while (($linea = fgets($fp)) !== false) {
                // Separar la línea por el delimitador "#"
                $separar = explode("#", $linea);

                // Si el primer elemento coincide con el ID buscado
                if (trim($separar[0]) == $matricula) {
                    // Mostrar el vehículo encontrado
                    /*
                    printf(
                        "%-10s | %-15s | %-10s | %-10s | %-15s",
                        $separar[0],
                        $separar[1],
                        $separar[2],
                        $separar[3],
                        $separar[4]
                    ); 
                    */
                    //echo "Encontrado";
                    fclose($fp);
                    return $linea;
                }                
            }
        
            // Cerrar el archivo después de leerlo
            fclose($fp);
            return null;
        }   
                
        // Borrado de coche 
        public function eliminar($matricula) {
            // Verificar si el coche existe
            if ($this->obtenerCoche($matricula) == null) {
                echo "--Coche no existe.\n";
                return false;
            }
        
            // Abrir el archivo en modo lectura/escritura
            $fp = fopen($this->ficheroCoche, 'r+');
            if (!$fp) {
                echo "No se pudo abrir el archivo.\n";
                return false;
            }
        
            $lineaEncontrada = false; // Para saber si se encontró la matrícula
        
            // Calcular la cantidad de líneas en el archivo
            while (($linea = fgets($fp)) !== false) {
                $posActual = ftell($fp) - 90; // Retrocedemos a la posición inicial de la línea
                $matriculaArchivo = trim(substr($linea, 0, strlen($matricula))); // Obtener matrícula de la línea
        
                if ($matriculaArchivo === $matricula) {
                    $lineaEncontrada = true;
        
                    // Mover el puntero al inicio de la línea encontrada
                    fseek($fp, -94, SEEK_CUR);
        
                    // Sobrescribir la línea con espacios para "eliminar" lógicamente
                    fputs($fp, "-1      ");
        
                    echo "--Coche eliminado correctamente.\n";
                    break;
                }
            }
        
            // Cerrar el archivo
            fclose($fp);
        
            if (!$lineaEncontrada) {
                echo "--No se encontró el coche con la matrícula indicada.\n";
                return false;
            }
            return true;
        }

        public function eliminar2($matricula) {
            // Verificar si el coche existe
            if ($this->obtenerCoche($matricula) == null) {
                echo "--Coche no existe.\n";
                return false;
            }
        
            // Abrir el archivo en modo lectura/escritura
            $fp = fopen($this->ficheroCoche, 'r+');
            if (!$fp) {
                echo "No se pudo abrir el archivo para leer.\n";
                return false;
            }
        
            // Variables de control
            $tamanioLinea = 0;  // Longitud de la línea encontrada
            $posicionLinea = -1;  // Posición de la línea que contiene la matrícula
        
            // Buscar la línea con la matrícula especificada
            while (($linea = fgets($fp)) !== false) {
                $tamanioLinea = strlen($linea); // Longitud de la línea actual
                $separar = explode("#", $linea);
        
                // Comparar la matrícula (suponiendo que es el primer campo)
                if (trim($separar[0]) === $matricula) {
                    // Obtener la posición de la línea actual
                    $posicionLinea = ftell($fp) - $tamanioLinea;
                    break;
                }
            }
        
            // Si no se encontró la matrícula
            if ($posicionLinea === -1) {
                echo "--No se encontró el coche con la matrícula indicada.\n";
                fclose($fp);
                return false;
            }
        
            // Mover el puntero al inicio de la línea encontrada
            fseek($fp, $posicionLinea, SEEK_SET);
        
            // Sobrescribir la línea con espacios o marcadores (eliminar lógicamente)
            fwrite($fp, str_pad("", $tamanioLinea - 1)); // El -1 es para el salto de línea
        
            echo "--Coche eliminado correctamente.\n";
        
            fclose($fp);
            return true;
        }        
        
        // Modificación de Coche
        public function actualizar($matricula, Coche $cocheNuevo) {
            // Abrir el archivo original en modo lectura
            $fp = fopen($this->ficheroCoche, 'r');
            if (!$fp) {
                echo "No se pudo abrir el archivo para leer.\n";
                return false;
            }
        
            // Leer todas las líneas del archivo
            $lineas = [];
            while (($linea = fgets($fp)) !== false) {
                $lineas[] = $linea;
            }
            fclose($fp);
            
            // Buscar la línea correspondiente a la matrícula
            $encontrado = false;
            $lineasActualizadas = [];
            foreach ($lineas as $linea) {
                // Extraer matrícula desde la línea (primeros 10 caracteres)
                $matriculaLinea = trim(substr($linea, 0, 10));
                if ($matriculaLinea === $coche->matricula) {
                    // Generar la línea actualizada con formato de longitud fija
                    $lineaNueva = implode("", [
                        str_pad($coche->matricula, 10, " ", STR_PAD_RIGHT),
                        str_pad($coche->marca, 30, " ", STR_PAD_RIGHT),
                        str_pad($coche->modelo, 30, " ", STR_PAD_RIGHT),
                        str_pad($coche->potencia, 10, " ", STR_PAD_RIGHT),
                        str_pad($coche->velocidadMax, 10, " ", STR_PAD_RIGHT)
                    ]) . "\n";
        
                    $lineasActualizadas[] = $lineaNueva;
                    $encontrado = true; // Marcar como encontrado
                } else {
                    $lineasActualizadas[] = $linea; // Mantener la línea original
                }
            }
        
            if (!$encontrado) {
                echo "--No se encontró un coche con la matrícula: {$coche->matricula}\n";
                return false;
            }
        
            // Escribir de nuevo las líneas actualizadas en el archivo
            $fp = fopen($this->ficheroCoche, 'w');
            if (!$fp) {
                echo "--No se pudo abrir el archivo para escribir.";
                return false;
            }
        
            foreach ($lineasActualizadas as $linea) {
                fputs($fp, $linea);
            }
            fclose($fp);
        
            echo "--Coche actualizado correctamente.\n";
            return true;
        }   
        
        // devuelve todos los coches almacenados en el fichero
        public function verTodos(){
            // Abrir el archivo en modo de lectura
            $fp = fopen($this->ficheroCoche, 'r');

            if (!$fp) {
                echo("No se pudo abrir el archivo para leer.");
                return;
            }
            // Leer y mostrar el archivo línea por línea
            while (($linea = fgets($fp)) !== false) {
                // Mostrar cada línea leída (ya incluye el salto de línea)
                $separar = explode("#", $linea);

                // Validar que tenga al menos 5 elementos antes de imprimir
                
                    printf(
                        "%-10s | %-30s | %-30s | %-10s | %-10s",
                        $separar[0],
                        $separar[1],
                        $separar[2],
                        $separar[3],
                        $separar[4]
                    );
                
            }
            // Cerrar el archivo después de leerlo
            fclose($fp); 
        }
    }
    $cocheDAO = new CocheDAO();
    $menu = <<<'MENU'
    0) Mostrar menú.
    1) Alta nueva de coche.
    2) Baja por matrícula.
    3) Modificación.
    4) Listado de coches.
    5) Obtener coche.
    6) Salir de la aplicación.
    MENU;
    echo $menu;

    $opcion = readline("\n\nIntroducen el número de opción: ");
    while ($opcion < 6) {
        switch($opcion){
            case 0:
                echo $menu;
                break;
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
            
                // Llamar al método para eliminar el coche 
                $cocheDAO->eliminar($matricula);
                break;
            case 3:
                // Solicitar la matrícula del coche a modificar
                $matricula = null; 
                while ($matricula == null) {
                    $matricula = readline("\nIntroduce la matrícula del coche que deseas modificar: ");
                }

                // Obtener el coche existente
                $cocheActual = $cocheDAO->obtenerCoche($matricula);
                if ($cocheActual === null) {
                    echo "--Coche no encontrado. No se puede modificar.\n";
                    return;
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
                
                if ($cocheDAO->actualizar($cocheNuevo)) {
                    echo "Coche actualizado correctamente.\n";
                } else {
                    echo "Error al actualizar el coche.\n";
                }
                break;
            case 4:
                $cocheDAO->verTodos();
                break;
            case 5:
                $matricula = readline("Introducen la matricula: ");
                $cocheDAO->obtenerCoche($matricula);
                break;

        }
        $opcion = readline("\nIntroducen otro número de opción: ");
    }
?>