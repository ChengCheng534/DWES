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
            // Abrir el archivo en modo 'a' para añadir al final
            $fp = fopen($this->ficheroCoche, 'a');
    
            // Verificar si el archivo se abrió correctamente
            if (!$fp) {
                echo "No se pudo abrir el archivo para escribir.";
                return false;
            }
            // Escribir los datos del coche en el archivo, separados por "#"
            $linea = implode("#", [
                $coche->matricula,
                $coche->marca,
                $coche->modelo,
                $coche->potencia,
                $coche->velocidadMax
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
        
            $encontrado = false;
        
            // Leer el archivo línea por línea
            while (($linea = fgets($fp)) !== false) {
                // Separar la línea por el delimitador "#"
                $separar = explode("#", $linea);

                // Si el primer elemento coincide con el ID buscado
                if (trim($separar[0]) == $matricula) {
                    // Mostrar el vehículo encontrado
                    printf(
                        "%-10s | %-15s | %-10s | %-10s | %-15s",
                        $separar[0],
                        $separar[1],
                        $separar[2],
                        $separar[3],
                        $separar[4]
                    );
                    $encontrado = true;
                    break;
                }                
            }
        
            // Cerrar el archivo después de leerlo
            fclose($fp);
        
            // Si no se encontró el vehículo
            if (!$encontrado) {
                echo "Vehículo con ID '$idBuscado' no encontrado.\n";
            }
        }   
                
        // Borrado de coche 
        public function eliminar($matricula) {
            // Abrir el archivo original en modo lectura
            $fp = fopen($this->ficheroCoche, 'r');
        
            if (!$fp) {
                echo "No se pudo abrir el archivo para leer.\n";
                return false;
            }
        
            // Crear un archivo temporal para escribir los datos actualizados
            $fpTemp = fopen('temp_coches.txt', 'w');
            if (!$fpTemp) {
                echo "No se pudo crear el archivo temporal.\n";
                fclose($fp);
                return false;
            }
        
            $encontrado = false;
        
            // Leer cada línea del archivo original
            while (($linea = fgets($fp)) !== false) {
                // Separar la línea por el delimitador '#'
                $linea = rtrim($linea);
        
                // Separar la línea por el delimitador '#'
                $datos = explode("#", $linea);

                // Comprobar si la matrícula coincide
                if (count($datos) > 0 && $datos[0] === $matricula) {
                    $encontrado = true;
                    continue; // Saltar esta línea (no se copia al archivo temporal)
                }
        
                // Escribir la línea en el archivo temporal si no coincide la matrícula
                fputs($fpTemp, $linea. "\n");
            }
        
            // Cerrar ambos archivos
            fclose($fp);
            fclose($fpTemp);
        
            // Si no se encontró la matrícula, no reemplazamos el archivo
            if (!$encontrado) {
                echo "No se encontró ningún coche con la matrícula: $matricula.\n";
                unlink('temp_coches.txt'); // Eliminar el archivo temporal
                return false;
            }
        
            // Reemplazar el archivo original con el temporal
            rename('temp_coches.txt', $this->ficheroCoche);
            echo "Coche con matrícula $matricula eliminado correctamente.\n";
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
        
            // Crear un archivo temporal para escribir los datos actualizados
            $fpTemp = fopen('temp_coches.txt', 'w');
            if (!$fpTemp) {
                echo "No se pudo crear el archivo temporal.\n";
                fclose($fp);
                return false;
            }
        
            $encontrado = false;
        
            // Leer cada línea del archivo original
            while (($linea = fgets($fp)) !== false) {
                // Eliminar saltos de línea al final de la línea
                $linea = rtrim($linea);
        
                // Separar la línea por el delimitador '#'
                $datos = explode("#", $linea);
        
                // Si la matrícula coincide, actualizar la línea
                if (count($datos) > 0 && trim($datos[0]) === trim($matricula)) {
                    $encontrado = true;
        
                    // Crear la nueva línea con los datos del coche actualizado
                    $nuevaLinea = implode("#", [
                        $cocheNuevo->matricula,
                        $cocheNuevo->marca,
                        $cocheNuevo->modelo,
                        $cocheNuevo->potencia,
                        $cocheNuevo->velocidadMax
                    ]) . "\n";
        
                    // Escribir la nueva línea en el archivo temporal
                    fputs($fpTemp, $nuevaLinea);
                } else {
                    // Si no es el coche que queremos actualizar, copiar la línea original
                    fputs($fpTemp, $linea . "\n");
                }
            }
        
            // Cerrar ambos archivos
            fclose($fp);
            fclose($fpTemp);
        
            // Si no se encontró la matrícula, no reemplazamos el archivo
            if (!$encontrado) {
                echo "No se encontró ningún coche con la matrícula: $matricula.\n";
                unlink('temp_coches.txt'); // Eliminar el archivo temporal
                return false;
            }
        
            // Reemplazar el archivo original con el temporal
            rename('temp_coches.txt', $this->ficheroCoche);
            echo "Coche con matrícula $matricula actualizado correctamente.\n";
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
                        "%-10s | %-15s | %-10s | %-10s | %-4s",
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
    1) Alta nueva de Coche.
    2) Baja por matrícula.
    3) Modificación.
    4) Listado de coches.
    5) Obtener coche.
    6) Salir de la aplicación.
    MENU;
    echo $menu;

    $opcion = readline("\nIntroducen el número de opción: ");
    while ($opcion < 6) {
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
                // Solicitar la matrícula del coche a modificar
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
            case 5:
                $matricula = readline("Introducen la matricula: ");
                $cocheDAO->obtenerCoche($matricula);
                break;

        }
        $opcion = readline("\nIntroducen otro número de opción: \n");
    }
?>