<?php
require_once 'ICocheDAO.php';

class CocheDAO implements ICocheDAO {
    private $filePath = 'VehiculoDAO.json';

    // Constructor: verifica si el archivo existe, si no, lo crea vacío
    public function __construct() {
        if (!file_exists($this->filePath)) {
            file_put_contents($this->filePath, json_encode([]));
        }
    }

    // Método para leer el archivo JSON
    private function leerFichero() {
        $data = file_get_contents($this->filePath);
        return json_decode($data, true);
    }

    // Método para escribir en el archivo JSON
    private function escribirFichero($data) {
        file_put_contents($this->filePath, json_encode($data, JSON_PRETTY_PRINT));
    }

    // Crear un coche
    public function darAlta(Coche $coche) {
        $coches = $this->leerFichero();
        if (isset($coches[$coche->matricula])) {

            return;
        }
        $coches[$coche->matricula] = [
            'marca' => $coche->marca,
            'modelo' => $coche->modelo,
            'potencia' => $coche->potencia,
            'velocidadMaxima' => $coche->velocidadMaxima
        ];
        $this->escribirFichero($coches);
    }

    // Obtener un coche por su matrícula
    public function obtenerCoche($matricula) {
        $coches = $this->leerFichero();
        if (isset($coches[$matricula])) {
            $datos = $coches[$matricula];
            return new Coche($matricula, $datos['marca'], $datos['modelo'], $datos['potencia'], $datos['velocidadMaxima']);
        }
        return null;
    }

    // Eliminar un coche por su matrícula
    public function darBaja($matricula) {
        $coches = $this->leerFichero();
        if (isset($coches[$matricula])) {
            unset($coches[$matricula]);
            $this->escribirFichero($coches);
            echo "Coche con matrícula $matricula eliminado.\n";
        } else {
            echo "No se encontró un coche con matrícula $matricula.\n";
        }
    }

    // Actualizar un coche existente
    public function  modificarCoche($matricula, Coche $nuevoCoche) {
        $coches = $this->leerFichero();
        if (isset($coches[$matricula])) {
            $coches[$matricula] = [
                'marca' => $nuevoCoche->marca,
                'modelo' => $nuevoCoche->modelo,
                'potencia' => $nuevoCoche->potencia,
                'velocidadMaxima' => $nuevoCoche->velocidadMaxima
            ];
            $this->escribirFichero($coches);
            echo "Coche con matrícula $matricula actualizado.\n";
        } else {
            echo "No se encontró un coche con matrícula $matricula.\n";
        }
    }

    // Ver todos los coches
    public function verTodos() {
        $coches = $this->leerFichero();
        $listaCoches = [];
        foreach ($coches as $matricula => $datos) {
            $listaCoches[] = new Coche($matricula, $datos['marca'], $datos['modelo'], $datos['potencia'], $datos['velocidadMaxima']);
        }
        return $listaCoches;
    }
}
?>
