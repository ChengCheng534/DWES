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
        private $ficheroCoche = 'coche.csv';

        // Alta de coche
        /* Tamaño de valor: total(90)
            Matricula(10)
            Marca(30)
            Modelo(30)
            Potencia(10)
            VelocidadMax(10)
        */
        public function crear(Coche $coche) {
            //Comprobar si el fichero exite

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
            ]) .PHP_EOL;

            //echo $linea;
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
                $matriculaArchivo = trim(substr($linea, 0, strlen($matricula))); // Obtener matrícula de la línea
        
                if ($matriculaArchivo === $matricula) {
                    $lineaEncontrada = true;
        
                    // Mover el puntero al inicio de la línea encontrada
                    fseek($fp, -96, SEEK_CUR);
        
                    // Sobrescribir la línea con espacios para "eliminar" lógicamente
                    fputs($fp, "-1      ");
        
                    echo "--Coche eliminado correctamente.\n";
                    echo $linea;
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
        
        // Modificación de Coche
        public function actualizar($matricula, Coche $cocheNuevo) {
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

            $lineaEncontrada = false;
            //localizamos el coche con la matricula
            while (($linea = fgets($fp)) !== false) {
                $matriculaCoche = trim(substr($linea, 0, 10));

                if ($matriculaCoche === $matricula) {
                    $lineaEncontrada = true;
        
                    // Mover el puntero al inicio de la línea actual
                    fseek($fp, -96, SEEK_CUR);

                    // Campo: Marca (Inicio en posición 10, longitud 30)
                    fseek($fp, 11, SEEK_CUR); // Mover al inicio del campo "marca"
                    fputs($fp, str_pad(substr($cocheNuevo->marca, 0, 30), 30, " ", STR_PAD_RIGHT));

                    // Campo: Modelo (Inicio en posición 40, longitud 30)
                    fseek($fp, 42 - (11 + 30), SEEK_CUR); // Mover al inicio del campo "modelo"
                    fputs($fp, str_pad(substr($cocheNuevo->modelo, 0, 30), 30, " ", STR_PAD_RIGHT));

                    // Campo: Potencia (Inicio en posición 70, longitud 10)
                    fseek($fp, 73 - (42 + 30), SEEK_CUR); // Mover al inicio del campo "potencia"
                    fputs($fp, str_pad(substr($cocheNuevo->potencia, 0, 10), 10, " ", STR_PAD_RIGHT));

                    // Campo: Velocidad Máxima (Inicio en posición 80, longitud 10)
                    fseek($fp, 84 - (73 + 10), SEEK_CUR); // Mover al inicio del campo "velocidadMax"
                    fputs($fp, str_pad(substr($cocheNuevo->velocidadMax, 0, 10), 10, " ", STR_PAD_RIGHT));

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
                $marca = readline("Modifica la marca : ");
                $modelo = readline("Modifica el modelo : ");
                $potencia = readline("Modifica la potencia : ");
                $velocidad = readline("Modifica la velocidad máxima: ");

                // Crear el nuevo objeto Coche con los valores modificados (si no están vacíos)
                $cocheNuevo = new Coche(
                    $matricula,
                    !empty($marca) ? $marca : $cocheActual['marca'],
                    !empty($modelo) ? $modelo : $cocheActual['modelo'],
                    !empty($potencia) ? $potencia : $cocheActual['potencia'],
                    !empty($velocidad) ? $velocidad : $cocheActual['velocidadMax']
                );
                
                if ($cocheDAO->actualizar($matricula, $cocheNuevo)) {
                    echo "--Coche actualizado correctamente.\n";
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