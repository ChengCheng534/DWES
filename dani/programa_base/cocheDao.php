<!-- Crear la clase CocheDAO que implementa la interfaz ICocheDAO y que realice las operaciones sobre el fichero JSON. -->

<?php

include_once "coche.php";
include_once "icoche.php";

class CocheDao implements ICocheDAO
{
    private $archivoCoche = './bbdd/coche.json';

    public function crear(Coche $coche)
    {
        // Convertir el objeto Coche a un array
        $cocheArray = [
            'matricula' => $coche->matricula,
            'marca' => $coche->marca,
            'modelo' => $coche->modelo,
            'potencia' => $coche->potencia,
            'velocidadMaxima' => $coche->velocidadMaxima,
            'imagen' => $coche->imagen
        ];

        if (!file_exists($this->archivoCoche)) {
            $fp = fopen($this->archivoCoche, 'w');
            //fwrite ($fp, "[]");
            fclose($fp);
        }

        $json_archivo = file_get_contents($this->archivoCoche);

        if ($json_archivo === false) {
            die("No se pudo leer el archivo.");
        }

        // Convertir el contenido JSON en un array PHP
        $arrayArchivo = json_decode($json_archivo, true);

        if ($arrayArchivo  === null) {
            $arrayArchivo  = [];
            array_push($arrayArchivo, $cocheArray);
        } else {
            if (is_object($this->obtenerCoche($coche->matricula))) {
                return false;
            } else {
                array_push($arrayArchivo, $cocheArray);
            }
        }

        // Convertir el array de coches a formato JSON
        $json_coches = json_encode($arrayArchivo, JSON_PRETTY_PRINT); // JSON_PRETTY_PRINT para formato legible

        // Escribir el JSON en el archivo
        if (file_put_contents($this->archivoCoche, $json_coches) === false) {
            die("No se pudo guardar el archivo JSON.");
        }
        return true;
    }

    // Devuelve el coche buscado	
    public function obtenerCoche($matricula)
    {
        // Leer el contenido del archivo JSON
        $json_archivo = file_get_contents($this->archivoCoche);

        if ($json_archivo === false) {
            die("No se pudo leer el archivo.");
        }

        // Convertir el contenido JSON en un array PHP
        $arrayCoches = json_decode($json_archivo, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            die("Error al decodificar el JSON: " . json_last_error_msg());
        }

        foreach ($arrayCoches as $valorCoche) {

            if ($valorCoche['matricula'] === $matricula) {
                $c = new Coche($valorCoche['matricula'], $valorCoche['marca'], $valorCoche['imagen']);
                $c->modelo = $valorCoche['modelo'];
                $c->potencia = $valorCoche['potencia'];
                $c->velocidadMaxima = $valorCoche['velocidadMaxima'];
                return $c;
            }
        }
        return null;
    }

    // Borrado de coche
    public function eliminar($matricula)
    {
        $json_archivo = file_get_contents($this->archivoCoche);
        $coches = json_decode($json_archivo, true);

        foreach ($coches as $key => $coche) {
            if ($coche['matricula'] === $matricula) {
                unset($coches[$key]);
                $json_coches = json_encode(array_values($coches), JSON_PRETTY_PRINT);
                file_put_contents($this->archivoCoche, $json_coches);
                return true;
            }
        }
        return false;
    }

    // Modificación de Coche
    public function actualizar($matricula, Coche $nuevoCoche)
    {
        $json_archivo = file_get_contents($this->archivoCoche);
        $coches = json_decode($json_archivo, true);
        if ($json_archivo === false || $coches == null) {
            return false;
        } else {
            foreach ($coches as $key => $coche) {
                if ($coche['matricula'] === $matricula) {
                    $coches[$key] = [
                        'matricula' => $nuevoCoche->matricula,
                        'marca' => $nuevoCoche->marca,
                        'modelo' => $nuevoCoche->modelo,
                        'potencia' => $nuevoCoche->potencia,
                        'velocidadMaxima' => $nuevoCoche->velocidadMaxima,
                        'imagen' => $nuevoCoche->imagen
                    ];
                    $json_coches = json_encode($coches, JSON_PRETTY_PRINT);
                    file_put_contents($this->archivoCoche, $json_coches);
                    return true;
                }
            }
            return false;
        }
    }


    // Devuelve todos los coches almacenados en el fichero
    public function verTodos()
    {
        $json_archivo = file_get_contents($this->archivoCoche);
        $coches = json_decode($json_archivo, true);

        if ($json_archivo === false || $coches == null) {
            return false;
        } else {
            echo "<ul class='car-list'>";
            foreach ($coches as $coche) {
                echo "<li class='car-item'>";
                echo "<div class='car-info'>";
                echo "<h2>" . $coche['marca'] . " " . $coche['modelo'] . "</h2>";
                echo "<p><strong>Matrícula:</strong> " . $coche['matricula'] . "</p>";
                echo "<p><strong>Potencia:</strong> " . $coche['potencia'] . " CV</p>";
                echo "<p><strong>Velocidad Máxima:</strong> " . $coche['velocidadMaxima'] . " km/h</p>";
                echo "</div>";
                echo "<div class='car-image'>";
                echo "<img src='" . $coche['imagen'] . "' alt='Imagen de " . $coche['marca'] . "'>";
                echo "</div>";
                echo "</li>";
            }
            echo "</ul>";
            return true;
        }
    }
}
